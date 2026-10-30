@extends('layouts.app')

@section('title', 'Amar Laundry - Pemesanan (Cash Only)')

@section('content')
<div class="max-w-xl w-full mx-auto px-6 py-10">
    <div class="bg-white text-gray-900 rounded-3xl p-6 sm:p-8 shadow-2xl border-4 border-teal-700/20">
        
        <div class="border-b border-gray-100 pb-4 mb-6 text-center">
            <span class="text-xs font-bold text-teal-700 bg-teal-50 px-3 py-1 rounded-full border border-teal-100">
                💵 Tunai di Tempat (Cash on Delivery)
            </span>
            <h2 class="text-2xl font-extrabold text-gray-900 mt-3">Formulir Pesan Amar Laundry</h2>
            <p class="text-xs text-gray-500 mt-1">Isi formulir dan kurir kami siap menjemput cucian ke lokasi Anda.</p>
        </div>

        @if(isset($errors) && $errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-xs mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form id="orderForm" action="{{ route('pesan.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nama Lengkap</label>
                    <input type="text" id="inputNama" name="nama" value="{{ old('nama', Auth::user()->name ?? '') }}" placeholder="Nama Anda" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0f8281] outline-none text-sm text-gray-800 transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">No. WhatsApp</label>
                    <input type="tel" id="inputWhatsapp" name="whatsapp" value="{{ old('whatsapp', Auth::user()->whatsapp ?? '') }}" placeholder="0812xxxxxxxx" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0f8281] outline-none text-sm text-gray-800 transition">
                </div>
            </div>

            <div class="space-y-3">
                <label class="block text-xs font-extrabold uppercase text-gray-400 tracking-wider">Pilih Layanan</label>
                
                <label class="service-card flex items-center justify-between p-4 rounded-2xl border-2 border-teal-600 bg-teal-50/50 cursor-pointer transition">
                    <div class="flex items-center space-x-3">
                        <input type="radio" name="layanan" value="Express 3 Jam (Rp 15.000/kg)" checked class="service-radio w-4 h-4 text-teal-600">
                        <div>
                            <p class="text-sm font-extrabold text-gray-900">⚡ Express (Selesai 3 Jam)</p>
                            <p class="text-xs text-gray-500">Rp 15.000 /kg • 1 Mesin 1 Pelanggan</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-extrabold bg-[#ffc72c] text-gray-900 px-2.5 py-1 rounded-full uppercase">Paling Cepat</span>
                </label>

                <label class="service-card flex items-center justify-between p-4 rounded-2xl border-2 border-gray-200 cursor-pointer transition">
                    <div class="flex items-center space-x-3">
                        <input type="radio" name="layanan" value="Reguler 1 Hari (Rp 8.000/kg)" class="service-radio w-4 h-4 text-teal-600">
                        <div>
                            <p class="text-sm font-extrabold text-gray-900">🧺 Reguler (Selesai 1 Hari)</p>
                            <p class="text-xs text-gray-500">Rp 8.000 /kg • Wangi & Bersih Higienis</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold text-teal-700 bg-teal-50 px-2.5 py-1 rounded-full border border-teal-100">Hemat</span>
                </label>
            </div>

            <div>
                <label class="block text-xs font-extrabold uppercase text-gray-400 tracking-wider mb-1">Alamat Penjemputan</label>
                <textarea id="inputAlamat" name="alamat" rows="2" placeholder="Masukkan alamat lengkap rumah / kost / nomor kamar kamu..." required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0f8281] outline-none text-sm text-gray-800 transition">{{ old('alamat') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-extrabold uppercase text-gray-400 tracking-wider mb-1">Catatan Tambahan (Opsional)</label>
                <input type="text" id="inputCatatan" name="catatan" value="{{ old('catatan') }}" placeholder="Contoh: Baju putih tolong dipisah / telepon saat sudah di gerbang" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0f8281] outline-none text-sm text-gray-800 transition">
            </div>

            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-start space-x-3">
                <span class="text-amber-600 font-bold text-lg">💡</span>
                <div class="text-xs text-amber-800 leading-relaxed">
                    <p class="font-bold">Ketentuan Pembayaran Tunai:</p>
                    <p>Pembayaran dilakukan secara tunai (Cash) langsung kepada kurir saat penjemputan cucian.</p>
                </div>
            </div>

            <!-- Tombol Pemicu Modal Konfirmasi -->
            <button type="button" onclick="showConfirmationModal()" class="w-full bg-[#ffc72c] hover:bg-yellow-400 text-gray-900 font-extrabold py-3.5 rounded-xl shadow-lg transition cursor-pointer flex items-center justify-center space-x-2">
                <span>Lanjut Konfirmasi Pesanan</span>
                <span>→</span>
            </button>
        </form>

    </div>
</div>

<!-- ============================================== -->
<!-- POPUP MODAL KONFIRMASI ULANG PESANAN          -->
<!-- ============================================== -->
<div id="confirmModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-white text-gray-900 rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border-4 border-teal-700/20 transform transition-all animate-in fade-in zoom-in-95">
        
        <!-- Header Modal -->
        <div class="text-center pb-4 border-b border-gray-100">
            <div class="w-12 h-12 bg-teal-50 text-teal-700 rounded-2xl flex items-center justify-center text-2xl mx-auto mb-2 border border-teal-100">
                📋
            </div>
            <h3 class="text-xl font-extrabold text-gray-900">Konfirmasi Rincian Pesanan</h3>
            <p class="text-xs text-gray-500 mt-1">Periksa kembali data Anda sebelum kami mengirimkan kurir.</p>
        </div>

        <!-- Ringkasan Data -->
        <div class="py-4 space-y-3 text-xs">
            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 space-y-2.5">
                <div class="flex justify-between items-center pb-2 border-b border-gray-200/60">
                    <span class="text-gray-500 font-medium">Nama Pelanggan:</span>
                    <span id="previewNama" class="font-extrabold text-gray-900">-</span>
                </div>
                <div class="flex justify-between items-center pb-2 border-b border-gray-200/60">
                    <span class="text-gray-500 font-medium">No. WhatsApp:</span>
                    <span id="previewWhatsapp" class="font-bold text-teal-700">-</span>
                </div>
                <div class="flex justify-between items-center pb-2 border-b border-gray-200/60">
                    <span class="text-gray-500 font-medium">Paket Layanan:</span>
                    <span id="previewLayanan" class="font-extrabold text-gray-900">-</span>
                </div>
                <div class="flex flex-col pb-2 border-b border-gray-200/60">
                    <span class="text-gray-500 font-medium mb-1">Alamat Penjemputan:</span>
                    <span id="previewAlamat" class="font-semibold text-gray-800 bg-white p-2.5 rounded-xl border border-gray-200 leading-relaxed">-</span>
                </div>
                <div class="flex justify-between items-center pb-2 border-b border-gray-200/60">
                    <span class="text-gray-500 font-medium">Catatan Khusus:</span>
                    <span id="previewCatatan" class="font-semibold text-gray-700 italic">-</span>
                </div>
                <div class="flex justify-between items-center pt-1">
                    <span class="text-gray-500 font-medium">Metode Pembayaran:</span>
                    <span class="font-extrabold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">💵 Tunai (Cash di Tempat)</span>
                </div>
            </div>
            
            <p class="text-[11px] text-amber-700 bg-amber-50 p-3 rounded-xl border border-amber-200 text-center">
                ⚠️ Pastikan nomor WhatsApp aktif agar kurir kami dapat menghubungi saat penjemputan.
            </p>
        </div>

        <!-- Tombol Aksi Modal -->
        <div class="grid grid-cols-2 gap-3 pt-2">
            <button type="button" onclick="closeConfirmationModal()" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 rounded-xl transition text-xs">
                ← Periksa Kembali
            </button>
            <button type="button" id="btnSubmitOrder" onclick="submitFinalOrder()" class="w-full bg-[#ffc72c] hover:bg-yellow-400 text-gray-900 font-extrabold py-3 rounded-xl shadow-md transition text-xs">
                ✓ Ya, Pesan Sekarang
            </button>
        </div>

    </div>
</div>

<script>
    // Styling pilihan radio card
    document.querySelectorAll('.service-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.service-card').forEach(card => {
                card.classList.remove('border-teal-600', 'bg-teal-50/50');
                card.classList.add('border-gray-200');
            });
            const parentLabel = this.closest('label');
            parentLabel.classList.remove('border-gray-200');
            parentLabel.classList.add('border-teal-600', 'bg-teal-50/50');
        });
    });

    // Tampilkan Modal Konfirmasi
    function showConfirmationModal() {
        const form = document.getElementById('orderForm');

        // Validasi input form HTML5
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const nama = document.getElementById('inputNama').value.trim();
        const whatsapp = document.getElementById('inputWhatsapp').value.trim();
        const alamat = document.getElementById('inputAlamat').value.trim();
        const catatan = document.getElementById('inputCatatan').value.trim();
        
        const layananRadio = document.querySelector('input[name="layanan"]:checked');
        const layanan = layananRadio ? layananRadio.value : 'Express 3 Jam';

        // Tampilkan data ke preview modal
        document.getElementById('previewNama').textContent = nama || '-';
        document.getElementById('previewWhatsapp').textContent = whatsapp || '-';
        document.getElementById('previewLayanan').textContent = layanan;
        document.getElementById('previewAlamat').textContent = alamat || '-';
        document.getElementById('previewCatatan').textContent = catatan || 'Tidak ada catatan';

        // Buka popup modal
        const modal = document.getElementById('confirmModal');
        modal.classList.remove('hidden');
    }

    // Tutup Modal Konfirmasi
    function closeConfirmationModal() {
        const modal = document.getElementById('confirmModal');
        modal.classList.add('hidden');
    }

    // Submit Form
    function submitFinalOrder() {
        const btn = document.getElementById('btnSubmitOrder');
        btn.disabled = true;
        btn.innerHTML = 'Memproses Pesanan...';
        document.getElementById('orderForm').submit();
    }
</script>
@endsection
