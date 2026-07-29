<div class="inline-flex items-center gap-1.5">
    @can('pegawai-edit')
    <a href="{{ route('pegawai.edit', $pegawai->id) }}"
       class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition-all shadow-sm shadow-indigo-600/20"
       title="Ubah Data Pegawai">
        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
        <span>Edit</span>
    </a>
    @endcan

    @can('pegawai-delete')
    {{ html()->form('DELETE', route('pegawai.destroy', $pegawai->id))->id('delete-pegawai-' . $pegawai->id)->class('inline')->open() }}
    <button type="button" onclick="confirmDeletePegawai({{ $pegawai->id }})"
            class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition-all shadow-sm shadow-rose-600/20"
            title="Hapus Data Pegawai">
        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
        </svg>
        <span>Hapus</span>
    </button>
    {{ html()->form()->close() }}
    @endcan
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