/**
 * @jest-environment node
 */
const { chromium } = require('playwright');

jest.setTimeout(60000); // 設定 Jest 測試超時 60 秒

describe('測試網站自動化測試', () => {
    let browser;
    let page;

    beforeAll(async () => {
        browser = await chromium.launch({
            headless: true,
            args: ['--no-sandbox', '--disable-setuid-sandbox']
        });
        page = await browser.newPage();
        await page.goto('http://140.129.13.169/test-website/index.php', { waitUntil: 'load' });
    });

    afterAll(async () => {
        if (browser) {
            await browser.close();
        }
    });

    test('測試錯誤提交（少於 3 個字符）', async () => {
        await page.fill('#name', 'AB');
        await Promise.all([
            page.waitForNavigation(), // 等待 `process.php` 處理完成並返回 `index.php`
            page.click('button[type="submit"]')
        ]);

        await page.waitForSelector('#errorMessage', { timeout: 20000 });

        const errorMessage = await page.textContent('#errorMessage');
        expect(errorMessage).toBe('名字必須至少包含 3 個字符！');
    });

    test('檢查正確提交是否顯示歡迎訊息', async () => {
        await page.fill('#name', '測試名稱');
        await Promise.all([
            page.waitForNavigation(),
            page.click('button[type="submit"]')
        ]);

        await page.waitForSelector('h2', { timeout: 20000 }); // 確保 h2 存在
		const responseText = await page.textContent('h2');
        expect(responseText).toContain('你好, 測試名稱!');
    });

    test('檢查首頁標題', async () => {
        const title = await page.title();
        expect(title).toBe('測試網站首頁');
    });

    test('檢查首頁是否包含關鍵內容', async () => {
        const content = await page.textContent('h1');
        expect(content).toContain('歡迎來到測試網站');
    });

    test('檢查圖片是否載入成功', async () => {
        await page.waitForFunction(() => {
            const img = document.querySelector('img[alt="測試圖片"]');
            return img && img.complete && img.naturalHeight !== 0;
        }, { timeout: 20000 });

        const imageLoaded = await page.$eval('img[alt="測試圖片"]', img => img.complete && img.naturalHeight !== 0);
        expect(imageLoaded).toBeTruthy();
    });
});
