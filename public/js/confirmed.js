// // 確認ボタン
// const checkedButton = document.getElementById("checked");

// // 確認ボタンの非同期処理クリックイベント
// checkedButton.addEventListener('click',async function() {

//     try {
//         const button = document.getElementById("checked");
//         button.innerText = '確認済です';
//         button.style.backgroundColor = 'red';
//     } catch (error) {
//         document.getElementById('result').innerText = `エラー: ${error.message}`;
//     }
// });




// 確認ボタン
const checkedButton = document.getElementById("checked");

// 非同期処理のシミュレーション関数
function simulateAsyncOperation() {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve('成功');
            // エラーをシミュレートする場合は以下の行を使用
            reject(new Error('何かがうまくいかなかった'));
        }, 1000); // 2秒後に処理完了
    });
}

// 確認ボタンの非同期処理クリックイベント
checkedButton.addEventListener('click', async function() {
    try {
        // ボタンを無効化
        checkedButton.disabled = true;
        // 非同期処理のシミュレーション
        const result = await simulateAsyncOperation();
        // ボタンのテキストとスタイルを変更
        checkedButton.innerText = '確認済です';
        checkedButton.style.backgroundColor = 'red';
    } catch (error) {
        // エラーが発生した場合はボタンを再び有効化する場合もある
        checkedButton.disabled = false;
    }
});
