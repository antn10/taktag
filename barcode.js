document.addEventListener('DOMContentLoaded', () => {
    const codeReader = new ZXing.BrowserBarcodeReader();

    const videoElement = document.getElementById('video');
    const resultElement = document.getElementById('result');

    codeReader.decodeFromInputVideoDevice(undefined, 'video', (result, err) => {
        if (result) {
            resultElement.textContent = result.text;
        }
        if (err && !(err instanceof ZXing.NotFoundException)) {
            console.error(err);
            resultElement.textContent = 'Error: ' + err;
        }
    })
    .catch(err => {
        console.error(err);
    });
});
