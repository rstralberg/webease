
class cropper {

    form = null;
    canvas = null;

    moverDiv = null;
    resizerDiv = null;

    isMoving = false;
    moveOffsetX = 0;
    moveOffsetY = 0;

    isResizing = false;
    resizeOffsetX = 0;
    resizeOffsetY = 0;

    left = 0;
    top = 0;
    width = 0;
    height = 0;

    img = null;
    ctx = null;
    canvasDiv = null;


    constructor(img, callback, square = false) {

        this.img = img;

        const W = 600;
        const H = 600;

        this.form = document.createElement('form');
        this.form.style.position = 'absolute';
        this.form.style.left = '10vw';
        this.form.style.height = '10vh';
        this.form.style.width = W + 'px';
        this.form.style.height = H + 'px';
        this.form.style.background = '#202020';
        this.form.style.border = '2px dashed red';
        this.form.id = 'cropper';

        let body = document.querySelector('body');
        body.appendChild(this.form);


        this.canvasDiv = document.createElement('div');
        this.canvasDiv.classList.add('cropper');
        this.canvasDiv.style.left = 0;
        this.canvasDiv.style.top = 0;
        this.canvasDiv.style.width = W + 'px';
        this.canvasDiv.style.height = H + 'px';
        this.canvasDiv.style.display = 'block';
        this.canvasDiv.style.position = 'absolute';
        this.canvasDiv.style.background = 'rgba(200,0,0,0.3)';
        this.form.appendChild(this.canvasDiv);

        this.moverDiv = document.createElement('div');
        this.moverDiv.classList.add('crop-mover');
        this.canvasDiv.appendChild(this.moverDiv);

        this.resizerDiv = document.createElement('div');
        this.resizerDiv.classList.add('crop-resizer');
        this.canvasDiv.appendChild(this.resizerDiv);


        this.canvas = document.createElement('canvas');
        this.width = this.canvas.width = this.form.clientWidth;
        this.height = this.canvas.height = this.form.clientHeight;
        this.ctx = this.canvas.getContext('2d');
        this.ctx.drawImage(this.img, 0, 0);
        this.canvasDiv.appendChild(this.canvas);

        let button = document.createElement('input');
        button.style.position = 'absolute';
        button.style.width = '120px';
        button.style.height = '2em';
        button.style.bottom = '-3em';
        button.style.left = '0';
        button.type = 'button';
        button.value = 'Spara';
        button.addEventListener('click', (e) => {
            this.ctx.clearRect(0,0,this.canvas.width, this.canvas.height);
            this.ctx.drawImage(this.img, this.left, this.top, this.width, this.height, 0, 0,this.width, this.height  );
            this.img.src = this.canvas.toDataURL();
            let body = document.querySelector('body');
            body.removeChild(this.form);
            callback(this.img);
            return;

        });
        this.form.appendChild(button);

        button = document.createElement('input');
        button.style.position = 'absolute';
        button.style.width = '120px';
        button.style.height = '2em';
        button.style.bottom = '-3em';
        button.style.left = '140px';
        button.type = 'button';
        button.value = 'Avbryt';
        button.addEventListener('click', (e) => {
            let body = document.querySelector('body');
            body.removeChild(this.form);
            return;
        });
        this.form.appendChild(button);


        this.isMoving = false;
        this.isResizing = false;

        this.moverDiv.addEventListener('mousedown', (e) => {
            this.isMoving = true;
            this.moveOffsetX = e.offsetX;
            this.moveOffsetY = e.offsetY;
        });

        this.resizerDiv.addEventListener('mousedown', (e) => {
            this.isResizing = true;
            this.resizeOffsetX = e.offsetX;
            this.resizeOffsetY = e.offsetY;
        });

        this.form.addEventListener('mousemove', (e) => {
            if (this.isMoving) {
                this.left = e.offsetX + this.moveOffsetX;
                this.top = e.offsetY + this.moveOffsetY;
                if (this.left + this.width > this.canvas.width) {
                    this.width = this.canvas.width - this.left;
                }
                if (this.top + this.height > this.canvas.height) {
                    this.height = this.canvas.height - this.top;
                }
                this.draw();
            }
            else if (this.isResizing) {
                if ((e.offsetX - this.resizeOffsetX) > 100) {
                    this.width = e.offsetX - this.resizeOffsetX;
                    if (square) {
                        this.height = this.width;
                    }
                }
                if ((e.offsetY - this.resizeOffsetY) > 100) {
                    this.height = e.offsetY - this.resizeOffsetY;
                    if (square) {
                        this.width = this.height ;
                    }
                }
                this.draw();
            }
        });

        this.form.addEventListener('mouseup', (e) => {
            this.isMoving = false;
            this.isResizing = false;
        });
        this.draw();
    }

    draw() {

        const BorderWidth = 4;
        const Size = 24;

        this.ctx.clearRect(0, 0, this.canvas.width - BorderWidth, this.canvas.height - BorderWidth);

        this.ctx.drawImage(this.img, 0, 0);

        this.ctx.beginPath();
        this.ctx.lineWidth = BorderWidth;
        this.ctx.strokeStyle = 'cyan';
        this.ctx.moveTo(this.left, this.top);
        this.ctx.lineTo(this.left + this.width - BorderWidth, this.top);
        this.ctx.lineTo(this.left + this.width - BorderWidth, this.top + this.height - BorderWidth);
        this.ctx.lineTo(this.left, this.top + this.height - BorderWidth);
        this.ctx.lineTo(this.left, this.top);
        this.ctx.stroke();

        this.ctx.beginPath();
        this.ctx.lineWidth = 2;
        this.ctx.strokeStyle = 'white';
        this.ctx.fillStyle = 'green';
        this.ctx.moveTo(this.left, this.top);
        this.ctx.lineTo(this.left + Size, this.top);
        this.ctx.lineTo(this.left, this.top + Size);
        this.ctx.fill();
        this.ctx.stroke();

        this.moverDiv.style.left = this.left + 'px';
        this.moverDiv.style.top = this.top + 'px';

        this.ctx.beginPath();
        this.ctx.lineWidth = 2;
        this.ctx.fillStyle = 'red';
        this.ctx.strokeStyle = 'white';

        this.ctx.moveTo(this.left + this.width - Size, this.top + this.height);
        this.ctx.lineTo(this.left + this.width, this.top + this.height);
        this.ctx.lineTo(this.left + this.width, this.top + this.height - Size);
        this.ctx.fill();
        this.ctx.stroke();

        this.resizerDiv.style.left = this.left + this.width - this.resizerDiv.clientWidth + 'px';
        this.resizerDiv.style.top = this.top + this.height - this.resizerDiv.clientHeight + 'px';


    }
}

