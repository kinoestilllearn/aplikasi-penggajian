<div class="inline-flex items-center gap-1.5">
    <a href="{{ route('penggajian.show', $penggajian->id) }}"
       class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition-all shadow-sm shadow-indigo-600/20"
       title="Lihat Detail / Approval">
        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        </svg>
        <span>Detail</span>
    </a>
    <a href="{{ route('generate-pdf', $penggajian->id) }}" target="_blank" rel="noopener noreferrer"
       class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold transition-all shadow-sm shadow-amber-500/20"
       title="Preview PDF Slip Gaji">
        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
        </svg>
        <span>PDF</span>
    </a>
    @can('penggajian-delete')
    {{ html()->form('DELETE', route('penggajian.destroy', $penggajian->id))->id('delete-penggajian-' . $penggajian->id)->class('inline')->open() }}
    <button type="button" onclick="confirmDeletePenggajian({{ $penggajian->id }})"
            class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition-all shadow-sm shadow-rose-600/20"
            title="Hapus Transaksi Penggajian">
        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
        </svg>
        <span>Hapus</span>
    </button>
    {{ html()->form()->close() }}
    @endcan
</div>

<script>
    if (typeof confirmDeletePenggajian === 'undefined') {
        function confirmDeletePenggajian(id) {
            if (confirm("Apakah Anda yakin akan menghapus data penggajian ini?")) {
                document.getElementById('delete-penggajian-' + id).submit();
            }
        }
    }
</script>