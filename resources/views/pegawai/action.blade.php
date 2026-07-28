<div class="inline-flex items-center gap-1">
    <a href="{{ route('pegawai.edit', $pegawai->id) }}"
       class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-700 hover:bg-indigo-600 hover:text-white transition-colors shadow-sm"
       title="Edit Pegawai">
        <i data-lucide="edit-3" class="w-4 h-4"></i>
    </a>
    {{ html()->form('DELETE', route('pegawai.destroy', $pegawai->id))->id('delete-pegawai-' . $pegawai->id)->class('inline')->open() }}
    <button type="button" onclick="confirmDeletePegawai({{ $pegawai->id }})"
            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition-colors shadow-sm"
            title="Hapus Pegawai">
        <i data-lucide="trash-2" class="w-4 h-4"></i>
    </button>
    {{ html()->form()->close() }}
</div>

<script>
    if (typeof confirmDeletePegawai === 'undefined') {
        function confirmDeletePegawai(id) {
            if (confirm("Apakah Anda yakin akan menghapus data pegawai ini?")) {
                document.getElementById('delete-pegawai-' + id).submit();
            }
        }
    }
</script>