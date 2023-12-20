
function vh2px(vh) {
    return (parseFloat(vh) * window.innerHeight) / 100;
}

function vw2px(vw) {
    return (parseFloat(vw) * window.innerWidth) / 100;
}


function buffer_to_base64(buffer) {
    let binary = "";
    const bytes = new Uint8Array(buffer);
    const len = bytes.byteLength;
    for (let i = 0; i < len; i++) {
        binary += String.fromCharCode(bytes[i]);
    }
    return btoa(binary);
}

function mp3_to_base64(inputFile) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        // Define an event handler for when the file is loaded
        reader.onload = function (e) {
            if (e.target) {
                const base64Data = buffer_to_base64(e.target.result);
                resolve(base64Data);
            }
            else {
                reject();
            }
        };
        // Read the file as an ArrayBuffer
        reader.readAsArrayBuffer(inputFile);
    });
}
