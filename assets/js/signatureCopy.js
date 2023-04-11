const btnCopy = document.querySelectorAll('.js-copy');

console.log(btnCopy)

if (btnCopy.length > 0) {
    btnCopy.forEach((btn) => {
        btn.addEventListener('click', doCopy);
    });
}

async function doCopy() {
    console.log(this.dataset.target)
    const target = this.dataset.target;
    const fromElement = document.querySelector(target);

    if (!fromElement) {
        return;
    }

    const range = document.createRange();
    const selection = window.getSelection();

    range.selectNode(fromElement);
    selection.removeAllRanges();
    selection.addRange(range);

    try {
        const result = await navigator.clipboard.writeText(fromElement.textContent);
        if (result) {
            alert('Signature copié !');
        }
    } catch (e) {
        alert(e);
    }

    selection.window.getSelection();
    if (typeof selection.removeRange=== 'function') {
        selection.removeRange(range)
    } else if (typeof selection.removeAllRanges === 'function') {
        selection.removeAllRanges();
    }
}