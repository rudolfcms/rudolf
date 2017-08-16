var pre = document.querySelectorAll('.trace li');

for (var i = 0; i < pre.length; i++) {
    pre[i].addEventListener('click', function() {
        this.classList.toggle('show');
        this.querySelector('pre').addEventListener('click', function(e){e.stopPropagation();})
    });
}
