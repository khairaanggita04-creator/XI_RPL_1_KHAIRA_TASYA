function tampilkanNama() {
    document.getElementById("namaAnggota").innerHTML =
    `
    <ol
    style="list-style-type: decimal;
    padding-left:5%;">
        <li>khaira (khaira@gmail.com)</li>
        <li>tasya (tasya@gmail.com)</li>
    </ol>

    <button onclick="location.reload()">
       tutup kembali
    </button>   

   `;
}