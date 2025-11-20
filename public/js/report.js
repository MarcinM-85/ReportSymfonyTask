let formFilterObj = document.querySelector('[data-report-form-filter]');

if( formFilterObj ) {
    formFilterObj.addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        fetch(form.getAttribute('action'), {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            document.querySelector('[data-report-list]').innerHTML = html;
        });
    });
}