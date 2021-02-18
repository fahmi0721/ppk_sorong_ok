$(document).ready(function(){
    
});

function FormMessage(judul,msg,tipe) {
    swal({
        title: judul,
        text: msg,
        type: tipe
    });
}

function Welcome(title, message) {
    setTimeout(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        toastr.success(message, title);
    }, 1300);
}

function PesanSukses(title,message){
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 4000
    };
    toastr.success(message, title);
    
}

function PesanError(title, message) {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 4000
    };
    toastr.error(message, title);
}

function PesanWarning(title, message) {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 4000
    };
    toastr.warning(message, title);;
}

function PesanInfo(title, message) {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 4000
    };
    toastr.info(message, title);;
}

function angka(objek) {
    a = objek.value;
    b = a.replace(/[^\d]/g, "");
    objek.value = b;
}