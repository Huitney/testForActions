/**
 * @jest-environment jsdom
 */

const { fireEvent, getByLabelText, getByText, screen } = require('@testing-library/dom');

describe('Index Page Form Tests', () => {
    let form, nameInput, submitBtn, errorMessage, greeting;

    // 在每次測試之前載入 HTML 結構
    beforeEach(() => {
        document.body.innerHTML = `
            <h1 id="greeting">請輸入你的名字</h1>

            <form method="POST" action="" id="nameForm">
                <label for="name">姓名: </label>
                <input type="text" id="name" name="name" required>
                <button type="submit" id="submitBtn">提交</button>
                <div class="error-message" id="errorMessage"></div>
            </form>
        `;

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

	test('當名稱輸入少於3個字符時，應該阻止表單提交', () => {
		fireEvent.input(nameInput, { target: { value: 'Al' } });

		// 模擬事件並附加 preventDefault
		const submitEvent = new Event('submit', { bubbles: true, cancelable: true });
		const preventDefault = jest.fn();
		form.addEventListener('submit', (event) => event.preventDefault = preventDefault);

		form.dispatchEvent(submitEvent);

		expect(preventDefault).toHaveBeenCalled(); // 確認 preventDefault 被調用
		expect(errorMessage.textContent).toBe('名字必須至少包含 3 個字符！');
	});

	test('當名稱輸入為3個或更多字符時，表單應成功提交', () => {
		fireEvent.input(nameInput, { target: { value: 'Alice' } });

		// 模擬事件並附加 preventDefault
		const submitEvent = new Event('submit', { bubbles: true, cancelable: true });
		const preventDefault = jest.fn();
		form.addEventListener('submit', (event) => event.preventDefault = preventDefault);

		form.dispatchEvent(submitEvent);

		expect(preventDefault).not.toHaveBeenCalled(); // 確認 preventDefault 未被調用
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
		jest.useFakeTimers(); // 使用假的計時器
		submitBtn.addEventListener('click', () => {
			submitBtn.style.transform = 'scale(0.95)';
			setTimeout(() => {
				submitBtn.style.transform = 'scale(1)';
			}, 150);
		});

		// 模擬點擊事件
		fireEvent.click(submitBtn);

		// 確保按下後樣式變化
		expect(submitBtn.style.transform).toBe('scale(0.95)');

		// 模擬 150ms 的時間流逝
		jest.advanceTimersByTime(150);

		// 確保樣式恢復
		expect(submitBtn.style.transform).toBe('scale(1)');

		jest.useRealTimers(); // 恢復真實計時器
	});
});
