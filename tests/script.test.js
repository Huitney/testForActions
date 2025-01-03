/**
 * @jest-environment jsdom
 */

const { fireEvent, getByLabelText, getByText, screen } = require('@testing-library/dom');

describe('Index Page Form Tests', () => {
    let form, nameInput, submitBtn, errorMessage, greeting;

    // 在每次測試之前載入 HTML 結構
    beforeEach(() => {
        document.body.innerHTML = 
            <h1 id="greeting">請輸入你的名字</h1>

            <form method="POST" action="" id="nameForm">
                <label for="name">姓名: </label>
                <input type="text" id="name" name="name" required>
                <button type="submit" id="submitBtn">提交</button>
                <div class="error-message" id="errorMessage"></div>
            </form>
        ;

        // 獲取 DOM 元素
        form = document.getElementById('nameForm');
        nameInput = document.getElementById('name');
        submitBtn = document.getElementById('submitBtn');
        errorMessage = document.getElementById('errorMessage');
        greeting = document.getElementById('greeting');
    });

    test('檢查網頁標題是否正確顯示', () => {
        expect(greeting.textContent).toBe('請輸入你的名字');
    });

    test('當使用者輸入名稱時，標題會及時更新', () => {
        fireEvent.input(nameInput, { target: { value: 'Alice' } });
        expect(greeting.textContent).toBe('你好, Alice!');
    });

    test('名稱輸入少於3個字符時，應該顯示錯誤消息', () => {
        fireEvent.input(nameInput, { target: { value: 'Al' } });
        fireEvent.submit(form);
        expect(errorMessage.textContent).toBe('名字必須至少包含 3 個字符！');
    });

    test('當名稱輸入為3個或更多字符時，表單應成功提交', () => {
        fireEvent.input(nameInput, { target: { value: 'Alice' } });
        const event = new Event('submit', { bubbles: true, cancelable: true });
        const preventDefault = jest.fn();
        event.preventDefault = preventDefault;
        form.dispatchEvent(event);
        expect(preventDefault).not.toHaveBeenCalled();
        expect(errorMessage.textContent).toBe('');
    });

    test('當使用者取消表單提交時，應阻止表單提交', () => {
        fireEvent.input(nameInput, { target: { value: 'Alice' } });
        global.confirm = jest.fn(() => false); // 模擬使用者點擊「取消」
        const event = new Event('submit', { bubbles: true, cancelable: true });
        const preventDefault = jest.fn();
        event.preventDefault = preventDefault;
        form.dispatchEvent(event);
        expect(preventDefault).toHaveBeenCalled();
    });

    test('當使用者確認提交時，表單應成功提交', () => {
        fireEvent.input(nameInput, { target: { value: 'Alice' } });
        global.confirm = jest.fn(() => true); // 模擬使用者點擊「確認」
        const event = new Event('submit', { bubbles: true, cancelable: true });
        const preventDefault = jest.fn();
        event.preventDefault = preventDefault;
        form.dispatchEvent(event);
        expect(preventDefault).not.toHaveBeenCalled();
    });

    test('檢查提交按鈕的點擊效果', () => {
        fireEvent.click(submitBtn);
        expect(submitBtn.style.transform).toBe('scale(0.95)');
        
        // 模擬 150ms 的時間流逝，確認按鈕恢復原始大小
        jest.useFakeTimers();
        fireEvent.click(submitBtn);
        jest.advanceTimersByTime(150);
        expect(submitBtn.style.transform).toBe('scale(1)');
    });
});