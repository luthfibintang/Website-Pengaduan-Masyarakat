/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";


// var path = location.pathname.split('/')
// var url = location.origin + '/' + path[1]

// $('ul.sidebar-menu li a').each(function(){
//     if($(this).attr('href').indexOf(url) !== -1){
//         $(this).parent().addClass('active').parent().parent('li').addClass('active')
//     }
// }) 

function closePrint(){
    document.body.removeChild($this.__container__);
}

function setPrint(){
    this.contentWindow.__container__ = this;
    this.contentWindow.onbeforeunload = closePrint();
    this.contentWindow.onafterunload = closePrint();
    this.contentWindow.focus();
    this.contentWindow.print();
}

function printPage(sURL){
    var onHideFrame = document.createElement("iframe");
    onHideFrame.onload = setPrint();
    onHideFrame.style.position = "fixed";
    onHideFrame.style.right = "0";
    onHideFrame.style.bottom = "0";
    onHideFrame.style.width = "0";
    onHideFrame.style.height = "0";
    onHideFrame.style.border = "0";
    onHideFrame.src = sURL;
    document.body.appendChild(onHideFrame);
}


const swalsukses = $('.swaldata').data('flashdata');
if(swalsukses){
    swal('kerja Bagus', swalsukses, 'success');
}

const swalred = $('.red').data('red');
if(swalred){
    swal('kerja Bagus', swalred, 'success');
}

$('.btn-hapus').on('click', function(e){
    e.preventDefault();
    const href = $(this).attr('href')

    swal({
        title: 'Yakin Ingin Menghapus?',
        text: 'Ketika didelete sudah tidak bisa lagi dikembalikan',
        icon: 'warning',
        buttons: {cancel: {
            text: "Cancel",
            value: null,
            visible: true,
            className: "",
            closeModal: true,
          },
          confirm: {
            text: "Delete",
            value: true,
            visible: true,
            className: "",
            closeModal: true
          }},
        
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            document.location.href = href;
        } else {
        swal('Data Anda Aman!');
        }
      });
})

