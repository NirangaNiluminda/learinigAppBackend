document.addEventListener('DOMContentLoaded', async () => {
    let searchParams = new URLSearchParams(window.location.search);
    if(searchParams.has('session_id')){
        const session_id = searchParams.get('session_id');
        document.getElementById('session_id').setAttribute('value', session_id);
    }
});