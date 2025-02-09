/**
 * @jest-environment jsdom
 */
const puppeteer = require('puppeteer');

describe('測試網站自動化測試', () => {
  let browser;
  let page;

  beforeAll(async () => {
    browser = await puppeteer.launch({
      executablePath: '/snap/bin/chromium',
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
    const content = await page.$eval('h1', el => el.textContent);
    expect(content).toContain('歡迎來到測試網站');
  });

  test('檢查表單提交是否顯示歡迎訊息', async () => {
    await page.type('#name', '測試名稱');
    await page.click('button[type="submit"]');
    await page.waitForSelector('h1'); 
    const responseText = await page.$eval('h1', el => el.textContent);
    expect(responseText).toContain('你好, 測試名稱!');
  });

  test('測試錯誤提交', async () => {
    await page.type('#name', 'AB');
    await page.click('button[type="submit"]');
    const errorMessage = await page.$eval('#errorMessage', el => el.textContent);
    expect(errorMessage).toBe('名字必須至少包含 3 個字符！');
  });

  test('檢查圖片是否載入成功', async () => {
    const imageLoaded = await page.$eval('img[alt="測試圖片"]', img => img.complete && img.naturalHeight !== 0);
    expect(imageLoaded).toBeTruthy();
  });

  test('檢查關於我們頁面標題', async () => {
    await page.goto('http://140.129.13.169/test-website/about.php');
    const aboutTitle = await page.$eval('h1', el => el.textContent);
    expect(aboutTitle).toContain('關於我們');
  });

  test('檢查聯絡我們頁面標題', async () => {
    await page.goto('http://140.129.13.169/test-website/contact.php');
    const contactTitle = await page.$eval('h1', el => el.textContent);
    expect(contactTitle).toContain('聯絡我們');
  });
});
