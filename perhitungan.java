// Data Kriteria dan Bobot (Persentase diubah ke desimal)
const kriteria = [
    { nama: "Kandungan Nutrisi", bobot: 0.20 },
    { nama: "Kandungan Kalsium", bobot: 0.25 },
    { nama: "Kandungan Gula", bobot: 0.15 },
    { nama: "Kandungan Protein", bobot: 0.15 },
    { nama: "Kandungan Lemak", bobot: 0.10 },
    { nama: "Harga", bobot: 0.05 },
    { nama: "Rasa", bobot: 0.05 },
    { nama: "Ketersediaan Produk", bobot: 0.05 }
];

// Data Alternatif (Nilai tiap kriteria dari skala 1-100)
const alternatif = [
    { nama: "Anline Gold Plus", nilai: [100, 100, 80, 80, 100, 60, 90, 100] },
    { nama: "Ensure Gold HMB", nilai: [100, 100, 60, 80, 50, 40, 90, 90] },
    { nama: "Appeton 60 Plus", nilai: [100, 100, 60, 80, 50, 40, 90, 70] },
    { nama: "Entrasol Platinum", nilai: [80, 100, 80, 80, 70, 60, 90, 100] },
    { nama: "Nestle Boost Optimum", nilai: [100, 100, 80, 100, 50, 60, 90, 90] }
    { nama: "Hilo Gold", nilai: [100, 100, 80, 80, 100, 60, 90, 100] }
    { nama: "Prosteo Plus", nilai: [100, 100, 80, 80, 70, 80, 90, 90] }
    { nama: "Vidoran Xmart Active", nilai: [100, 90, 80, 80, 70, 80, 90, 100] }
    { nama: "Frisian Flag Kompleta", nilai: [100, 90, 60, 80, 70, 80, 100, 100] }
    { nama: "Boneeto Adult Milk", nilai: [100, 100, 60, 80, 70, 100, 90, 100] }
];

// Normalisasi nilai (mengubah semua nilai ke skala 0-1 berdasarkan nilai maksimum)
function normalisasi(data, kriteria) {
    let maxValues = [];
    for (let i = 0; i < kriteria.length; i++) {
        maxValues[i] = Math.max(...data.map(alt => alt.nilai[i]));
    }
    
    return data.map(alt => ({
        nama: alt.nama,
        nilai: alt.nilai.map((val, i) => val / maxValues[i])
    }));
}

// Hitung nilai akhir dengan metode SMART
function hitungSMART(alternatif, kriteria) {
    let normalisasiData = normalisasi(alternatif, kriteria);
    
    return normalisasiData.map(alt => ({
        nama: alt.nama,
        skor: alt.nilai.reduce((acc, val, i) => acc + (val * kriteria[i].bobot), 0)
    })).sort((a, b) => b.skor - a.skor); // Urutkan dari nilai tertinggi ke terendah
}

// Jalankan perhitungan
const hasilSMART = hitungSMART(alternatif, kriteria);

// Tampilkan hasil peringkat
console.log("Hasil Perhitungan SMART:");
hasilSMART.forEach((alt, index) => {
    console.log(`${index + 1}. ${alt.nama} - Skor: ${alt.skor.toFixed(4)}`);
});
