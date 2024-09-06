const { JSDOM } = require('jsdom');

test('showMessage function displays the correct message', () => {
    // 模擬DOM環境
    const dom = new JSDOM(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Test</title>
        </head>
        <body>
            <button type="button" onclick="showMessage()">顯示訊息</button>
            <p id="message"></p>
            <script src="script.js"></script>
        </body>
        </html>
    `);

    // 設置全局環境
    global.document = dom.window.document;
    global.window = dom.window;
    require('../script.js');

    // 模擬點擊事件
    const button = document.querySelector('button');
    button.click();

    // 檢查消息是否正確顯示
    const message = document.getElementById('message').textContent;
    expect(message).toBe('這是一個由JavaScript顯示的訊息。');
});
