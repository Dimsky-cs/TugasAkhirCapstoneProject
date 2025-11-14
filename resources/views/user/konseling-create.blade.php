<x-app-layout>
    <div class="bg-gradient-to-br from-green-50 via-white to-pink-50 py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <!-- Notifikasi Error Validasi -->
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
                    <p class="font-bold">Oops! Terjadi kesalahan:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="px-8 py-6 bg-gray-50 border-b">
                    <h2 class="text-2xl font-bold text-gray-800 text-center">Buat Jadwal Konseling Anda</h2>
                    <p class="text-center text-gray-500 mt-1">Lengkapi formulir di bawah untuk mengatur sesi Anda.</p>
                </div>
                <div class="p-8">
                    <form id="booking-form" action="{{ route('user.konseling.store') }}" method="POST">
                        @csrf

                        <!-- Langkah 1: Informasi Kontak -->
                        <div class="mb-8">
                            <h3
                                class="text-lg font-semibold text-pink-600 border-b-2 border-pink-200 pb-2 mb-4 flex items-center">
                                <span
                                    class="bg-pink-500 text-white rounded-full h-8 w-8 text-sm font-bold flex items-center justify-center mr-3">1</span>
                                Informasi Kontak Anda
                            </h3>

                            <!-- Input Nama & Email Readonly (Revisi Fitur 1) -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                                <div>
                                    <label for="client_name_display"
                                        class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" id="client_name_display" value="{{ Auth::user()->name }}"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm sm:text-sm bg-gray-100 text-gray-500"
                                        readonly>
                                </div>
                                <div>
                                    <label for="client_email_display"
                                        class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                                    <input type="email" id="client_email_display" value="{{ Auth::user()->email }}"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm sm:text-sm bg-gray-100 text-gray-500"
                                        readonly>
                                </div>

                                <!-- [FITUR 2: INPUT TELEPON BARU] -->
                                <div class="md:col-span-2">
                                    <label for="client_phone_input"
                                        class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon
                                        (WhatsApp)</label>

                                    <!-- Input ini HANYA untuk tampilan & library -->
                                    <input type="tel" id="client_phone_input"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm"
                                        required>

                                    <!-- Input ini yang akan dikirim ke server (hidden) -->
                                    <input type="hidden" id="client_phone" name="client_phone"
                                        value="{{ old('client_phone', Auth::user()->phone) }}">

                                    @error('client_phone')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- [AKHIR FITUR 2] -->
                            </div>
                        </div>

                        <!-- Langkah 2: Detail Sesi (Sudah ada Fitur 4) -->
                        <div class="mb-8">
                            <h3
                                class="text-lg font-semibold text-green-600 border-b-2 border-green-200 pb-2 mb-4 flex items-center">
                                <span
                                    class="bg-green-500 text-white rounded-full h-8 w-8 text-sm font-bold flex items-center justify-center mr-3">2</span>
                                Detail Sesi Anda
                            </h3>

                            <div class="mt-4">
                                <label for="service_type" class="block text-sm font-medium text-gray-700 mb-1">Jenis
                                    Layanan</label>
                                <select id="service_type" name="service_type"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                    required>
                                    <option value="" disabled {{ old('service_type') ? '' : 'selected' }}>-- Pilih
                                        Jenis Layanan --</option>
                                    <option value="karier" {{ old('service_type') == 'karier' ? 'selected' : '' }}>
                                        Konseling Karier</option>
                                    <option value="stres" {{ old('service_type') == 'stres' ? 'selected' : '' }}>
                                        Konseling Stres</option>
                                    <option value="hubungan" {{ old('service_type') == 'hubungan' ? 'selected' : '' }}>
                                        Konseling Hubungan</option>
                                    <option value="kecemasan"
                                        {{ old('service_type') == 'kecemasan' ? 'selected' : '' }}>Konseling Kecemasan
                                    </option>
                                </select>
                            </div>

                            <div class="mt-4">
                                <label for="session_preference"
                                    class="block text-sm font-medium text-gray-700 mb-1">Preferensi Sesi</label>
                                <select id="session_preference" name="session_preference"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                    required>
                                    <option value="" disabled {{ old('session_preference') ? '' : 'selected' }}>
                                        -- Pilih Metode Konseling --</option>
                                    <option value="Video Call"
                                        {{ old('session_preference') == 'Video Call' ? 'selected' : '' }}>Video Call
                                        (via Google Meet)</option>
                                    <option value="Voice Call"
                                        {{ old('session_preference') == 'Voice Call' ? 'selected' : '' }}>Voice Call
                                        (via WhatsApp)</option>
                                    <option value="Chat Saja"
                                        {{ old('session_preference') == 'Chat Saja' ? 'selected' : '' }}>Chat Saja (via
                                        WhatsApp)</option>
                                </select>
                            </div>

                            <div class="mt-4">
                                <label for="psikolog_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih
                                    Psikolog</label>
                                <select id="psikolog_id" name="psikolog_id"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-gray-100 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                    required {{ old('service_type') ? '' : 'disabled' }}>
                                    <option value="" disabled selected>-- Pilih Layanan Dulu --</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                                <div>
                                    <label for="consultation_date"
                                        class="block text-sm font-medium text-gray-700 mb-1">Pilih Tanggal</label>
                                    <input type="date" id="consultation_date" name="consultation_date"
                                        value="{{ old('consultation_date') }}" min="{{ date('Y-m-d') }}"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-gray-100 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        required {{ old('psikolog_id') ? '' : 'disabled' }}>
                                </div>
                                <div>
                                    <label for="consultation_time"
                                        class="block text-sm font-medium text-gray-700 mb-1">Pilih Waktu</label>
                                    <select id="consultation_time" name="consultation_time"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-gray-100 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        required {{ old('consultation_date') ? '' : 'disabled' }}>
                                        <option value="" disabled selected>-- Pilih Psikolog & Tanggal --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Langkah 3: GUIDED PROMPTS (FITUR 3) -->
                        <div>
                            <h3
                                class="text-lg font-semibold text-gray-700 border-b-2 border-gray-200 pb-2 mb-4 flex items-center">
                                <span
                                    class="bg-gray-500 text-white rounded-full h-8 w-8 text-sm font-bold flex items-center justify-center mr-3">3</span>
                                Apa yang Paling Anda Rasakan?
                            </h3>
                            <p class="text-sm text-gray-500 mb-3">Pilih satu atau lebih tag yang paling mewakili
                                perasaan Anda saat ini.</p>

                            <input type="hidden" id="description" name="description" value="{{ old('description') }}">

                            <div id="prompt-tags-container" class="mb-4">
                                <span class="prompt-tag" data-value="Cemas">Cemas</span>
                                <span class="prompt-tag" data-value="Stres Kerja">Stres Kerja</span>
                                <span class="prompt-tag" data-value="Masalah Hubungan">Masalah Hubungan</span>
                                <span class="prompt-tag" data-value="Sulit Tidur">Sulit Tidur</span>
                                <span class="prompt-tag" data-value="Bingung Arah Hidup">Bingung Arah Hidup</span>
                                <span class="prompt-tag" data-value="Sedih">Sedih</span>
                                <span class="prompt-tag" data-value="Keluarga">Keluarga</span>
                            </div>

                            <label for="description_optional" class="text-sm font-medium text-gray-700 mb-1">Ada hal
                                lain yang ingin ditambahkan? (Opsional)</label>
                            <textarea id="description_optional" rows="3"
                                class="shadow-sm focus:ring-gray-500 focus:border-gray-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                placeholder="Tuliskan cerita singkat Anda di sini..."></textarea>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="mt-8 pt-5 border-t">
                            <div class="flex justify-end">
                                <a href="{{ route('dashboard') }}"
                                    class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="ms-3 inline-flex justify-center py-3 px-6 border border-transparent shadow-lg text-sm font-bold rounded-full text-white bg-pink-500 hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-transform transform hover:scale-105">
                                    Booking Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SCRIPT GABUNGAN (AJAX + GUIDED PROMPTS + INT-TEL-INPUT) -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {

                    // --- Variabel untuk AJAX Cek Jadwal ---
                    const serviceSelect = document.getElementById('service_type');
                    const psikologSelect = document.getElementById('psikolog_id');
                    const dateInput = document.getElementById('consultation_date');
                    const timeSelect = document.getElementById('consultation_time');
                    const oldPsikologId = '{{ old('psikolog_id') }}';
                    const oldTime = '{{ old('consultation_time') }}';

                    // --- Variabel untuk GUIDED PROMPTS ---
                    const tagsContainer = document.getElementById('prompt-tags-container');
                    const hiddenDescription = document.getElementById('description');
                    const optionalText = document.getElementById('description_optional');
                    let selectedTags = [];

                    // --- Variabel untuk INT-TEL-INPUT ---
                    const phoneInput = document.querySelector("#client_phone_input");
                    const hiddenPhoneInput = document.querySelector("#client_phone");
                    const bookingForm = document.querySelector("#booking-form");

                    // Inisialisasi intl-tel-input
                    const iti = window.intlTelInput(phoneInput, {
                        initialCountry: "id", // Default Indonesia
                        separateDialCode: true, // Tampilkan +62 terpisah
                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js", // Wajib untuk validasi & formatting
                    });

                    // Set nilai awal (jika ada dari 'old' atau 'auth')
                    if (hiddenPhoneInput.value) {
                        iti.setNumber(hiddenPhoneInput.value);
                    }

                    // Saat form di-submit, update hidden input dengan format internasional
                    bookingForm.addEventListener('submit', function() {
                        if (iti.isValidNumber()) {
                            hiddenPhoneInput.value = iti.getNumber(); // cth: +628123456789
                        } else {
                            // Jika mau, bisa tambahkan validasi frontend di sini
                            // Tapi kita sudah punya validasi regex di backend
                            // Jika nomor tidak valid, biarkan submit, nanti backend yang handle
                            // Untuk safety, kita set manual
                            hiddenPhoneInput.value = iti.getNumber();
                        }
                    });

                    // Update hidden input setiap kali user ganti negara atau mengetik
                    phoneInput.addEventListener('input', function() {
                        hiddenPhoneInput.value = iti.getNumber();
                    });
                    phoneInput.addEventListener('countrychange', function() {
                        hiddenPhoneInput.value = iti.getNumber();
                    });


                    // --- INISIALISASI GUIDED PROMPTS (FITUR 3) ---
                    function updateHiddenDescription() {
                        let tagString = selectedTags.join(', ');
                        let optionalString = optionalText.value.trim();
                        let finalDescription = tagString;
                        if (tagString && optionalString) {
                            finalDescription += ' - ' + optionalString;
                        } else if (optionalString) {
                            finalDescription = optionalString;
                        }
                        hiddenDescription.value = finalDescription;
                    }

                    tagsContainer.addEventListener('click', function(e) {
                        if (e.target.classList.contains('prompt-tag')) {
                            const tag = e.target;
                            const value = tag.dataset.value;
                            tag.classList.toggle('selected');

                            if (tag.classList.contains('selected')) {
                                selectedTags.push(value);
                            } else {
                                selectedTags = selectedTags.filter(t => t !== value);
                            }
                            updateHiddenDescription();
                        }
                    });

                    optionalText.addEventListener('input', updateHiddenDescription);

                    // --- LOGIKA AJAX (FITUR 2) ---

                    serviceSelect.addEventListener('change', function() {
                        const service = this.value;
                        resetPsikologDropdown('-- Memuat Psikolog... --');
                        resetTimeDropdown('-- Pilih Psikolog & Tanggal --');
                        dateInput.disabled = true;
                        dateInput.value = '';
                        dateInput.classList.add('bg-gray-100');

                        if (service) {
                            fetch(`/api/psikologs-by-service?service=${service}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.length > 0) {
                                        populatePsikologDropdown(data, oldPsikologId);
                                    } else {
                                        resetPsikologDropdown('-- Tidak ada psikolog untuk layanan ini --');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error fetching psikolog:', error);
                                    resetPsikologDropdown('-- Gagal memuat data --');
                                });
                        }
                    });

                    psikologSelect.addEventListener('change', function() {
                        dateInput.disabled = false;
                        dateInput.classList.remove('bg-gray-100');
                        resetTimeDropdown('-- Pilih Tanggal --');
                        dateInput.value = '';
                    });

                    dateInput.addEventListener('change', function() {
                        fetchAvailableTimes();
                    });

                    function fetchAvailableTimes() {
                        const psikologId = psikologSelect.value;
                        const date = dateInput.value;
                        if (!psikologId || !date) return;
                        resetTimeDropdown('-- Memuat jam tersedia... --');

                        fetch(`/api/available-times?psikolog_id=${psikologId}&date=${date}`)
                            .then(response => response.json())
                            .then(data => {
                                populateTimeDropdown(data, oldTime);
                            })
                            .catch(error => {
                                console.error('Error fetching available times:', error);
                                resetTimeDropdown('-- Gagal memuat jam --');
                            });
                    }

                    function resetPsikologDropdown(message) {
                        psikologSelect.innerHTML = `<option value="" disabled selected>${message}</option>`;
                        psikologSelect.disabled = true;
                        psikologSelect.classList.add('bg-gray-100');
                    }

                    function populatePsikologDropdown(psikologs, selectedId) {
                        psikologSelect.innerHTML = '<option value="" disabled selected>-- Pilih Psikolog Anda --</option>';
                        psikologs.forEach(psikolog => {
                            const option = document.createElement('option');
                            option.value = psikolog.id;
                            option.textContent = psikolog.name;
                            if (psikolog.id == selectedId) {
                                option.selected = true;
                            }
                            psikologSelect.appendChild(option);
                        });
                        psikologSelect.disabled = false;
                        psikologSelect.classList.remove('bg-gray-100');
                    }

                    function resetTimeDropdown(message) {
                        timeSelect.innerHTML = `<option value="" disabled selected>${message}</option>`;
                        timeSelect.disabled = true;
                        timeSelect.classList.add('bg-gray-100');
                    }

                    function populateTimeDropdown(times, selectedTime) {
                        if (times.length > 0) {
                            timeSelect.innerHTML = '<option value="" disabled selected>-- Pilih Jam --</option>';
                            times.forEach(time => {
                                const option = document.createElement('option');
                                option.value = time;
                                const hour = parseInt(time.split(':')[0]);
                                option.textContent = `${time} - ${String(hour + 1).padStart(2, '0')}:00`;
                                if (time == selectedTime) {
                                    option.selected = true;
                                }
                                timeSelect.appendChild(option);
                            });
                            timeSelect.disabled = false;
                            timeSelect.classList.remove('bg-gray-100');
                        } else {
                            resetTimeDropdown('-- Tidak ada jadwal tersedia --');
                        }
                    }

                    // Pemicu Otomatis (jika ada error validasi)
                    if (serviceSelect.value) {
                        serviceSelect.dispatchEvent(new Event('change'));
                        if ('{{ old('psikolog_id') }}' && '{{ old('consultation_date') }}') {
                            dateInput.disabled = false;
                            dateInput.classList.remove('bg-gray-100');
                            timeSelect.disabled = false;
                            timeSelect.classList.remove('bg-gray-100');

                            setTimeout(() => {
                                psikologSelect.value = '{{ old('psikolog_id') }}';
                                if (psikologSelect.value) {
                                    fetchAvailableTimes();
                                }
                            }, 500);
                        }
                    }

                    // Pemicu Otomatis untuk Guided Prompts (jika ada error validasi)
                    const oldDescription = '{{ old('description') }}';
                    if (oldDescription) {
                        const parts = oldDescription.split(' - ');
                        const tagsPart = parts[0] || '';
                        const optionalPart = parts[1] || (tagsPart.includes(',') ? '' : tagsPart);

                        const oldTags = tagsPart.split(', ').filter(Boolean);
                        document.querySelectorAll('.prompt-tag').forEach(tagEl => {
                            if (oldTags.includes(tagEl.dataset.value)) {
                                tagEl.classList.add('selected');
                                selectedTags.push(tagEl.dataset.value);
                            }
                        });

                        if (!tagsPart.includes(',') && !oldTags.length) {
                            optionalText.value = optionalPart;
                        } else if (parts.length > 1) {
                            optionalText.value = optionalPart;
                        }

                        updateHiddenDescription();
                    }
                });
            </script>
        </div>
    </div>
</x-app-layout>
