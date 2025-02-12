/**
 * @jest-environment node
 */
const { chromium } = require('playwright');

describe('測試網站自動化測試', () => {
  let browser;
  let page;

  beforeAll(async () => {
    browser = await chromium.launch({
      headless: true,
      args: ['--no-sandbox', '--disable-setuid-sandbox']
    });
    page = await browser.newPage();
    await page.goto('http://140.129.13.169/test-website/index.php');
  });

  afterAll(async () => {
    if (browser) {
      await browser.close();
    }
  });

  test('檢查首頁標題', async () => {
    const title = await page.title();
    expect(title).toBe('測試網站首頁');
  });

  test('檢查首頁是否包含關鍵內容', async () => {
    const content = await page.textContent('h1');
    expect(content).toContain('歡迎來到測試網站');
  });

  test('檢查表單提交是否顯示歡迎訊息', async () => {
    await page.fill('#name', '測試名稱');
    await page.click('button[type="submit"]');
    await page.waitForSelector('h1');
    const responseText = await page.textContent('h1');
    expect(responseText).toContain('你好, 測試名稱!');
  });

  test('測試錯誤提交', async () => {
    await page.fill('#name', 'AB');
    await page.click('button[type="submit"]');
    await page.waitForSelector('#errorMessage', { timeout: 10000 }); // 增加等待時間
    const errorMessage = await page.textContent('#errorMessage');
    expect(errorMessage).toBe('名字必須至少包含 3 個字符！');
  }, 15000); // 設定 Jest 測試 timeout 時間為 15 秒

  test('檢查圖片是否載入成功', async () => {
    await page.waitForSelector('img[alt="測試圖片"]', { timeout: 10000 }); // 增加等待時間
    const imageLoaded = await page.$eval('img[alt="測試圖片"]', img => img.complete && img.naturalHeight !== 0);
    expect(imageLoaded).toBeTruthy();
  }, 15000); // 設定 Jest 測試 timeout 時間為 15 秒

  test('檢查關於我們頁面標題', async () => {
    await page.goto('http://140.129.13.169/test-website/about.php');
    const aboutTitle = await page.textContent('h1');
    expect(aboutTitle).toContain('關於我們');
  });

  test('檢查聯絡我們頁面標題', async () => {
    await page.goto('http://140.129.13.169/test-website/contact.php');
    const contactTitle = await page.textContent('h1');
    expect(contactTitle).toContain('聯絡我們');
  });
});
