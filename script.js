function showMessage() {
    document.getElementById('message').textContent = '這是一個由JavaScript顯示的訊息。';
}

// 確保 showMessage 是全局函數
if (typeof window !== 'undefined') {
    window.showMessage = showMessage;
}
