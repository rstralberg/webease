
function server(php, args) {

    return new Promise((reply, reject) => {
        args.key = key();
        args.php = php;

        fetch('/php/redirect.php', {
            method: 'POST',
            body: JSON.stringify(args),
            headers: { 'Content-Type': 'application/json' }
        })
            .then(res => res.json())
            .then(res => {
                if (res.ok) {
                    reply(res.content);
                }
                else {
                    error(res.content);
                    reject(res.content);
                }
            })
            .catch(e => {
                error(e);
                reject(e);
            });
    });
}
