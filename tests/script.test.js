/**
 * @jest-environment jsdom
 */
const puppeteer = require('puppeteer');

describe('測試網站自動化測試', () => {
  let browser;
  let page;

  beforeAll(async () => {
    browser = await puppeteer.launch();
    page = await browser.newPage();
    await page.goto('http://140.129.13.169/test-website/index.php');
  });

  afterAll(async () => {
    await browser.close();
  });

  test('檢查首頁標題', async () => {
    const title = await page.title();
    expect(title).toBe('測試網站首頁');
  });

  test('檢查表單提交', async () => {
    await page.type('#name', '測試名稱');
    await page.click('button[type="submit"]');
    await page.waitForSelector('h1'); 
  });

  test('測試錯誤提交', async () => {
    await page.type('#name', 'AB');
    await page.click('button[type="submit"]');
    const alertMessage = await page.evaluate(() => alert());
    expect(alertMessage).toBe('名字需至少包含3個字符');
  });
});
