document.addEventListener('DOMContentLoaded', function() {

    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
           
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            button.classList.add('active');
            const tabId = button.getAttribute('data-tab');
            document.getElementById(`${tabId}-tab`).classList.add('active');
        });
    });
    
    const loadMoreButtons = document.querySelectorAll('.view-all .btn');
    
    loadMoreButtons.forEach(button => {
        button.addEventListener('click', function() {
           
            this.textContent = 'Loading...';
            
            setTimeout(() => {
                this.textContent = 'No more items to load';
                this.disabled = true;
            }, 1500);
        });
    });
    
});