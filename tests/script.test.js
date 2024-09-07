const { JSDOM } = require('jsdom');
const { showMessage } = require('../script'); // 導入 showMessage 函數

test('showMessage function displays the correct message', () => {
    // 模擬 DOM 環境
    const dom = new JSDOM(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Test</title>
        </head>
        <body>
            <button id="showMessageButton">顯示訊息</button>
            <p id="message"></p>
        </body>
        </html>
    `);

    // 設置全局環境
    global.document = dom.window.document;
    global.window = dom.window;

    // 模擬設置 onclick 事件
    const button = document.getElementById('showMessageButton');
    button.onclick = showMessage;

    // 模擬點擊事件
    button.click();

    // 檢查消息是否正確顯示
    const message = document.getElementById('message').textContent;
    expect(message).toBe('這是一個由JavaScript顯示的訊息。');
});
