$(function() {
   

$('.tombolTambahData').on('click', function() {

    $('#formModalLabel').html('Tambah Data Mahasiswa');
    $('.modal-footer button[type=submit]').html('Tambah Data');
    //agar form kembali kosong saat click tambah data
    $('#nama').val('');
    $('#nrp').val('');
    $('#email').val('');
    $('#jurusan').val('');
    $('#id').val('');
});

//jquery mencari class bernama tampilModalUbah -> lalu jika di clik 
//maka lakukan hal yang di inginkan user (perintah dalam {})
$('.tampilModalUbah').on('click', function() {

    //jquery mencari id bernama formModalLabel lalu ganti isinya
    //.html = isi dari idnnya
    $('#formModalLabel').html('Ubah Data Mahasiswa');
//jquery mencari class bernama modal-footer button tetapi typenya submit
//dan ubah isinya
    $('.modal-footer button[type=submit]').html('Ubah Data');
    //jquery mencari modal-body lalu formnya ubah attributnya (action) yang mengarah ke alamat dibawah
    $('.modal-body form').attr('action', 'http://localhost/phpmvc/public/mahasiswa/ubah')


    //this adalah tombol yang di clik lalu ambil datanya yang bernama id
    const id = $(this).data('id');
    

    //menjalankan ajax
    $.ajax({
    url: 'http://localhost/phpmvc/public/mahasiswa/getubah',
    data: {id : id}, //id sebelah kiri nama data yang dikirimkan, dan yang kanan isinya
    method: 'post', //agar bisa di tangkap menggunakan post
    dataType: 'json',
    //ketika berhasil maka di tangkap oleh variabel data
    success: function(data) {
        $('#nama').val(data.nama);
        $('#nrp').val(data.nrp);
        $('#email').val(data.email);
        $('#jurusan').val(data.jurusan);
        $('#id').val(data.id);
    }
    });

});

});