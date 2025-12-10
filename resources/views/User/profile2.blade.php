<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


    <div class="container mt-4">
        <h3>Form Input Data</h3>

        <form method="POST" action="{{ url('/edit-profile-user/1') }}" enctype="multipart/form-data">
            @csrf

            {{-- Full Name --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Full Name</label>
                <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror"
                    value="{{ old('full_name') }}">
                @error('full_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Phone --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Phone</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone') }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Address --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Address</label>
                <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address') }}</textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            {{-- Photo --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Photo</label>
                <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                    accept="image/*" onchange="previewPhoto(event)">
                <img id="photoPreview" class="img-thumbnail mt-2 {{ old('photo') ? '' : 'd-none' }}" width="150"
                    src="{{ old('photo') ? asset('storage/' . old('photo')) : '' }}">
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- File CV --}}
            <div class="mb-3">
                <label class="form-label fw-bold">File CV (PDF)</label>
                <input type="file" name="file_cv" class="form-control @error('file_cv') is-invalid @enderror"
                    accept="application/pdf" onchange="previewCV(event)">
                <span id="cvPreview" class="d-block mt-1 text-muted">{{ old('file_cv') ?? '' }}</span>
                @error('file_cv')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            {{-- JSON Buttons --}}
            <div class="mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#educationModal">
                    Education JSON
                </button>
                <input type="hidden" name="education_json" id="education_json" value="{{ old('education_json') }}">
                @error('education_json')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#certModal">
                    Certifications JSON
                </button>
                <input type="hidden" name="certifications_json" id="certifications_json"
                    value="{{ old('certifications_json') }}">
                @error('certifications_json')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#langModal">
                    Languages JSON
                </button>
                <input type="hidden" name="languages_json" id="languages_json" value="{{ old('languages_json') }}">
                @error('languages_json')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#expModal">
                    Experiences JSON
                </button>
                <input type="hidden" name="experiences_json" id="experiences_json"
                    value="{{ old('experiences_json') }}">
                @error('experiences_json')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#skillsModal">
                    Skills JSON
                </button>
                <input type="hidden" name="skills_json" id="skills_json" value="{{ old('skills_json') }}">
                @error('skills_json')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-success">Submit</button>
        </form>
    </div>

    {{-- ---------------------- MODALS ---------------------- --}}
    {{-- Education Modal (1 item + GPA) --}}
    <div class="modal fade" id="educationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Education JSON</h5><button class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="fw-bold">Program Studi</label>
                    <input type="text" id="edu_program" class="form-control mb-2">
                    <label class="fw-bold">Institusi</label>
                    <input type="text" id="edu_institusi" class="form-control mb-2">
                    <label class="fw-bold">Tahun Masuk</label>
                    <input type="number" id="edu_tahun" class="form-control mb-2">
                    <label class="fw-bold">IPK / GPA</label>
                    <input type="number" step="0.01" id="edu_gpa" class="form-control mb-2">
                    <label class="fw-bold">Catatan</label>
                    <textarea id="edu_catatan" class="form-control mb-2" rows="2"></textarea>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" onclick="saveEducation()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Certifications Modal --}}
    <div class="modal fade" id="certModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Certifications JSON</h5><button class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="cert_container"></div><button class="btn btn-sm btn-outline-secondary mt-2"
                        onclick="addCertItem()">+ Tambah Certification</button>
                </div>
                <div class="modal-footer"><button class="btn btn-primary"
                        onclick="saveCertifications()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Languages Modal --}}
    <div class="modal fade" id="langModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Languages JSON</h5><button class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="lang_container"></div><button class="btn btn-sm btn-outline-warning mt-2"
                        onclick="addLangItem()">+ Tambah Language</button>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" onclick="saveLanguages()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Experiences Modal --}}
    <div class="modal fade" id="expModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Experiences JSON</h5><button class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="exp_container"></div><button class="btn btn-sm btn-outline-info mt-2"
                        onclick="addExpItem()">+ Tambah Experience</button>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" onclick="saveExperiences()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Skills Modal --}}
    <div class="modal fade" id="skillsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Skills JSON</h5><button class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="skills_container"></div><button class="btn btn-sm btn-outline-dark mt-2"
                        onclick="addSkillItem()">+ Tambah Skill</button>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" onclick="saveSkills()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Photo Preview
            window.previewPhoto = function(event) {
                const img = document.getElementById("photoPreview");
                img.src = URL.createObjectURL(event.target.files[0]);
                img.classList.remove("d-none");
            }

            // CV Preview
            window.previewCV = function(event) {
                const file = event.target.files[0];
                document.getElementById("cvPreview").textContent = file ? file.name : '';
            }

            // --- Education ---
            const oldEduRaw = @json(old('education_json'));
            let oldEdu = {};
            try {
                oldEdu = oldEduRaw ? JSON.parse(oldEduRaw) : {};
            } catch (e) {
                oldEdu = {};
            }

            document.getElementById('edu_program').value = oldEdu.program_studi ?? '';
            document.getElementById('edu_institusi').value = oldEdu.institusi ?? '';
            document.getElementById('edu_tahun').value = oldEdu.tahun_masuk ?? '';
            document.getElementById('edu_gpa').value = oldEdu.gpa ?? '';
            document.getElementById('edu_catatan').value = oldEdu.catatan ?? '';

            window.saveEducation = function() {
                const data = {
                    program_studi: document.getElementById("edu_program").value,
                    institusi: document.getElementById("edu_institusi").value,
                    tahun_masuk: document.getElementById("edu_tahun").value,
                    gpa: document.getElementById("edu_gpa").value,
                    catatan: document.getElementById("edu_catatan").value
                };
                document.getElementById("education_json").value = JSON.stringify(data);
                alert("Education JSON tersimpan!");
            }

            // --- Helper untuk Dynamic Items ---
            function initDynamic(containerId, oldRaw) {
                const container = document.getElementById(containerId);
                let oldArr = [];
                try {
                    oldArr = oldRaw ? JSON.parse(oldRaw) : [];
                } catch (e) {
                    oldArr = [];
                }

                function addItem(value = "") {
                    const id = container.children.length + 1;
                    const html = `<div class="input-group mb-2">
                            <input type="text" class="form-control" value="${value}">
                            <button type="button" class="btn btn-danger" onclick="this.parentNode.remove()">X</button>
                          </div>`;
                    container.insertAdjacentHTML("beforeend", html);
                }

                // Load old items
                oldArr.forEach(v => addItem(v));

                return {
                    addItem
                };
            }

            // Certifications
            const certHelper = initDynamic('cert_container', @json(old('certifications_json')));
            window.addCertItem = () => certHelper.addItem();
            window.saveCertifications = () => {
                const arr = [];
                document.querySelectorAll('#cert_container input').forEach(i => {
                    if (i.value.trim()) arr.push(i.value.trim());
                });
                document.getElementById('certifications_json').value = JSON.stringify(arr);
                alert('Certifications JSON tersimpan!');
            }

            // Languages
            const langHelper = initDynamic('lang_container', @json(old('languages_json')));
            window.addLangItem = () => langHelper.addItem();
            window.saveLanguages = () => {
                const arr = [];
                document.querySelectorAll('#lang_container input').forEach(i => {
                    if (i.value.trim()) arr.push(i.value.trim());
                });
                document.getElementById('languages_json').value = JSON.stringify(arr);
                alert('Languages JSON tersimpan!');
            }

            // Experiences
            const expHelper = initDynamic('exp_container', @json(old('experiences_json')));
            window.addExpItem = () => expHelper.addItem();
            window.saveExperiences = () => {
                const arr = [];
                document.querySelectorAll('#exp_container input').forEach(i => {
                    if (i.value.trim()) arr.push(i.value.trim());
                });
                document.getElementById('experiences_json').value = JSON.stringify(arr);
                alert('Experiences JSON tersimpan!');
            }

            // Skills
            const skillHelper = initDynamic('skills_container', @json(old('skills_json')));
            window.addSkillItem = () => skillHelper.addItem();
            window.saveSkills = () => {
                const arr = [];
                document.querySelectorAll('#skills_container input').forEach(i => {
                    if (i.value.trim()) arr.push(i.value.trim());
                });
                document.getElementById('skills_json').value = JSON.stringify(arr);
                alert('Skills JSON tersimpan!');
            }

        });
    </script>


</body>

</html>
