function getRole(input) {
    if (input.value < 4) {
        alert("Mohon isi ID Pegawai");
        document.getElementById("employee").style.display = "block";
    } else {
        alert("Mohon isi Asal Instansi");
        document.getElementById("input_instansi").style.display = "block";
    }
}