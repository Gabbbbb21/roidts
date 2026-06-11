<script setup>
import { Head } from '@inertiajs/vue3';

// Props matching your backend schema parameters explicitly
const props = defineProps({
    request: {
        type: Object,
        required: true,
        default: () => ({
            id: null,
            docNo: '01-O-050726-839A0', 
            receivingOffice: 'RO1 - ORD', 
            doc_type: 'Invitation', 
            entryMode: 'Email', 
            documentDate: 'May 06, 2026 Wednesday', 
            receivedDate: 'May 07, 2026 Thursday', 
            nameOfParty: 'DIR. CORNELIA M. RILLERA', 
            notes: 'Civil Aviation Authority of the Philippines request for assistance providing a facilitator for the team building activity entitled "Waves of Unity Riding the Tide Together Indoors" on June 10-11, 2026, in Ilocos Norte', 
            signedBy: 'ROSITA G. TAMAYO, JR.', 
            enteredBy: 'ro1_ordadmin', 
            created_at: 'May 07, 2026 01:46pm Thursday' 
        })
    },
    // Captures the dynamic division string from the active modal workflow step
    selectedTargetDivision: {
        type: String,
        default: 'Unassigned Destination'
    }
});

// Explicit printing routine execution context
const triggerPrintJob = () => {
    if (typeof window !== 'undefined') {
        window.print();
    }
};
</script>

<template>
    <Head title="Transaction Snapshot" />

    <div class="p-4 bg-gray-100 min-h-screen font-sans flex flex-col items-center"> 
        <div class="half-a4-container bg-white border-2 border-black p-1 shadow-sm overflow-hidden flex flex-col justify-between"> 
             
            <div>
                <div class="flex border-b-2 border-black"> 
                    <div class="w-1/2 p-2 font-bold text-xs uppercase tracking-tight"> 
                        Daily Transaction (Snapshot) 
                    </div> 
                    <div class="w-1/2 p-2 text-right border-l-2 border-black"> 
                        <span class="font-bold text-[10px]">Doc No:</span>  
                        <span class="ml-2 font-mono text-sm">{{ request.docNo || 'PENDING' }}</span> 
                    </div> 
                </div> 

                <div class="grid grid-cols-2 border-b-2 border-black text-xs"> 
                    <div class="p-2 space-y-1 border-r-2 border-black"> 
                        <div class="flex"><span class="w-32 shrink-0">Receiving Office:</span> <span class="font-bold uppercase">{{ request.receivingOffice }}</span></div>
                        <div class="flex"><span class="w-32 shrink-0">Document Type:</span> <span class="font-bold text-[#0B2545]">{{ request.doc_type }}</span></div> 
                        <div class="flex"><span class="w-32 shrink-0">Document Date:</span> <span class="font-bold">{{ request.documentDate }}</span></div> 
                    </div> 
                    <div class="p-2 space-y-1"> 
                        <div class="flex"><span class="w-32 shrink-0">Destination:</span> <span class="font-black text-amber-700 uppercase">{{ selectedTargetDivision }}</span></div> 
                        <div class="flex"><span class="w-32 shrink-0">Entry Mode:</span> <span class="font-bold">{{ request.entryMode }}</span></div> 
                        <div class="flex"><span class="w-32 shrink-0">Received Date:</span> <span class="font-bold">{{ request.receivedDate }}</span></div> 
                    </div> 
                </div> 

                <div class="p-2 border-b-2 border-black space-y-2 text-xs"> 
                    <div class="flex"> 
                        <span class="w-32 shrink-0">Name of Party:</span>  
                        <span class="font-bold uppercase">{{ request.nameOfParty }}</span> 
                    </div> 
                    <div class="flex pb-1"> 
                        <span class="w-32 shrink-0">Document Details:</span>  
                        <span class="font-bold text-justify leading-tight flex-1 pr-1">{{ request.notes }}</span> 
                    </div> 
                     
                    <div class="flex pt-1 border-t border-gray-100"> 
                        <div class="w-1/2 flex items-center"> 
                            <span class="w-32 shrink-0">Signed By:</span> 
                            <span class="font-bold uppercase">{{ request.signedBy }}</span> 
                        </div> 
                        <div class="w-1/2 flex items-center"> 
                            <span class="w-24 shrink-0">Position:</span> 
                            <span class="font-bold border-b border-black flex-grow h-4"></span> 
                        </div> 
                    </div> 
                </div> 

                <div class="grid grid-cols-2 border-b-4 border-black text-[10px]"> 
                    <div class="p-2 flex items-center"> 
                        <span class="w-40">Entered/Updated By:</span> 
                        <span class="font-bold font-mono text-slate-700">{{ request.enteredBy }}</span> 
                    </div> 
                    <div class="p-2 flex items-center border-l-2 border-black"> 
                        <span class="w-32">Date Created:</span> 
                        <span class="font-bold font-mono text-slate-700">{{ request.created_at }}</span> 
                    </div> 
                </div> 

                <div class="grid grid-cols-2 min-h-[160px] text-[10px]"> 
                    <div class="p-2 space-y-2.5 border-r-2 border-black"> 
                        <div class="flex items-center"><span class="w-32">Date Due:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Date Received:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Action Required:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Accomplished:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Status:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                    </div> 
                    <div class="p-2 space-y-2.5"> 
                        <div class="flex items-center"><span class="w-32">Transaction No:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Current Office:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Action Person:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Next Office:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Action Taken:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                    </div> 
                </div> 
            </div>

            <div class="grid grid-cols-2 border-t-2 border-black text-[9px] uppercase font-bold text-gray-400"> 
                <div class="p-1 min-h-[20px]">Updated By:</div> 
                <div class="p-1 border-l-2 border-black min-h-[20px]">Updated On:</div> 
            </div> 
        </div> 
         
        <div class="mt-6 no-print"> 
            <button @click="triggerPrintJob" class="bg-[#0B2545] hover:bg-black text-white px-8 py-3 rounded font-bold shadow-md transition text-xs uppercase tracking-wider"> 
                Print Half-A4 Page 
            </button> 
        </div> 
    </div> 
</template> 

<style scoped> 
/* A4 Portrait dimensions definition layout specs */ 
.half-a4-container { 
    width: 210mm; 
    height: 148.5mm; 
    box-sizing: border-box; 
} 

@media print { 
    @page { 
        size: A4 portrait; 
        margin: 0; 
    } 

    .no-print {  
        display: none !important;  
    } 

    body {  
        background: white;  
        margin: 0; 
        padding: 0; 
    } 

    .half-a4-container { 
        border: 2px solid black !important; 
        box-shadow: none !important; 
        width: 210mm !important; 
        height: 148.5mm !important; 
        margin: 0 !important; 
        padding: 4mm !important; 
        page-break-inside: avoid;
    } 
} 
</style><script setup>
import { Head } from '@inertiajs/vue3';

// Props matching your backend schema parameters explicitly
const props = defineProps({
    request: {
        type: Object,
        required: true,
        default: () => ({
            id: null,
            docNo: '01-O-050726-839A0', 
            receivingOffice: 'RO1 - ORD', 
            doc_type: 'Invitation', 
            entryMode: 'Email', 
            documentDate: 'May 06, 2026 Wednesday', 
            receivedDate: 'May 07, 2026 Thursday', 
            nameOfParty: 'DIR. CORNELIA M. RILLERA', 
            notes: 'Civil Aviation Authority of the Philippines request for assistance providing a facilitator for the team building activity entitled "Waves of Unity Riding the Tide Together Indoors" on June 10-11, 2026, in Ilocos Norte', 
            signedBy: 'ROSITA G. TAMAYO, JR.', 
            enteredBy: 'ro1_ordadmin', 
            created_at: 'May 07, 2026 01:46pm Thursday' 
        })
    },
    // Captures the dynamic division string from the active modal workflow step
    selectedTargetDivision: {
        type: String,
        default: 'Unassigned Destination'
    }
});

// Explicit printing routine execution context
const triggerPrintJob = () => {
    if (typeof window !== 'undefined') {
        window.print();
    }
};
</script>

<template>
    <Head title="Transaction Snapshot" />

    <div class="p-4 bg-gray-100 min-h-screen font-sans flex flex-col items-center"> 
        <div class="half-a4-container bg-white border-2 border-black p-1 shadow-sm overflow-hidden flex flex-col justify-between"> 
             
            <div>
                <div class="flex border-b-2 border-black"> 
                    <div class="w-1/2 p-2 font-bold text-xs uppercase tracking-tight"> 
                        Daily Transaction (Snapshot) 
                    </div> 
                    <div class="w-1/2 p-2 text-right border-l-2 border-black"> 
                        <span class="font-bold text-[10px]">Doc No:</span>  
                        <span class="ml-2 font-mono text-sm">{{ request.docNo || 'PENDING' }}</span> 
                    </div> 
                </div> 

                <div class="grid grid-cols-2 border-b-2 border-black text-xs"> 
                    <div class="p-2 space-y-1 border-r-2 border-black"> 
                        <div class="flex"><span class="w-32 shrink-0">Receiving Office:</span> <span class="font-bold uppercase">{{ request.receivingOffice }}</span></div>
                        <div class="flex"><span class="w-32 shrink-0">Document Type:</span> <span class="font-bold text-[#0B2545]">{{ request.doc_type }}</span></div> 
                        <div class="flex"><span class="w-32 shrink-0">Document Date:</span> <span class="font-bold">{{ request.documentDate }}</span></div> 
                    </div> 
                    <div class="p-2 space-y-1"> 
                        <div class="flex"><span class="w-32 shrink-0">Destination:</span> <span class="font-black text-amber-700 uppercase">{{ selectedTargetDivision }}</span></div> 
                        <div class="flex"><span class="w-32 shrink-0">Entry Mode:</span> <span class="font-bold">{{ request.entryMode }}</span></div> 
                        <div class="flex"><span class="w-32 shrink-0">Received Date:</span> <span class="font-bold">{{ request.receivedDate }}</span></div> 
                    </div> 
                </div> 

                <div class="p-2 border-b-2 border-black space-y-2 text-xs"> 
                    <div class="flex"> 
                        <span class="w-32 shrink-0">Name of Party:</span>  
                        <span class="font-bold uppercase">{{ request.nameOfParty }}</span> 
                    </div> 
                    <div class="flex pb-1"> 
                        <span class="w-32 shrink-0">Document Details:</span>  
                        <span class="font-bold text-justify leading-tight flex-1 pr-1">{{ request.notes }}</span> 
                    </div> 
                     
                    <div class="flex pt-1 border-t border-gray-100"> 
                        <div class="w-1/2 flex items-center"> 
                            <span class="w-32 shrink-0">Signed By:</span> 
                            <span class="font-bold uppercase">{{ request.signedBy }}</span> 
                        </div> 
                        <div class="w-1/2 flex items-center"> 
                            <span class="w-24 shrink-0">Position:</span> 
                            <span class="font-bold border-b border-black flex-grow h-4"></span> 
                        </div> 
                    </div> 
                </div> 

                <div class="grid grid-cols-2 border-b-4 border-black text-[10px]"> 
                    <div class="p-2 flex items-center"> 
                        <span class="w-40">Entered/Updated By:</span> 
                        <span class="font-bold font-mono text-slate-700">{{ request.enteredBy }}</span> 
                    </div> 
                    <div class="p-2 flex items-center border-l-2 border-black"> 
                        <span class="w-32">Date Created:</span> 
                        <span class="font-bold font-mono text-slate-700">{{ request.created_at }}</span> 
                    </div> 
                </div> 

                <div class="grid grid-cols-2 min-h-[160px] text-[10px]"> 
                    <div class="p-2 space-y-2.5 border-r-2 border-black"> 
                        <div class="flex items-center"><span class="w-32">Date Due:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Date Received:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Action Required:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Accomplished:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Status:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                    </div> 
                    <div class="p-2 space-y-2.5"> 
                        <div class="flex items-center"><span class="w-32">Transaction No:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Current Office:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Action Person:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Next Office:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Action Taken:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                    </div> 
                </div> 
            </div>

            <div class="grid grid-cols-2 border-t-2 border-black text-[9px] uppercase font-bold text-gray-400"> 
                <div class="p-1 min-h-[20px]">Updated By:</div> 
                <div class="p-1 border-l-2 border-black min-h-[20px]">Updated On:</div> 
            </div> 
        </div> 
         
        <div class="mt-6 no-print"> 
            <button @click="triggerPrintJob" class="bg-[#0B2545] hover:bg-black text-white px-8 py-3 rounded font-bold shadow-md transition text-xs uppercase tracking-wider"> 
                Print Half-A4 Page 
            </button> 
        </div> 
    </div> 
</template> 

<style scoped> 
/* A4 Portrait dimensions definition layout specs */ 
.half-a4-container { 
    width: 210mm; 
    height: 148.5mm; 
    box-sizing: border-box; 
} 

@media print { 
    @page { 
        size: A4 portrait; 
        margin: 0; 
    } 

    .no-print {  
        display: none !important;  
    } 

    body {  
        background: white;  
        margin: 0; 
        padding: 0; 
    } 

    .half-a4-container { 
        border: 2px solid black !important; 
        box-shadow: none !important; 
        width: 210mm !important; 
        height: 148.5mm !important; 
        margin: 0 !important; 
        padding: 4mm !important; 
        page-break-inside: avoid;
    } 
} 
</style><script setup>
import { Head } from '@inertiajs/vue3';

// Props matching your backend schema parameters explicitly
const props = defineProps({
    request: {
        type: Object,
        required: true,
        default: () => ({
            id: null,
            docNo: '01-O-050726-839A0', 
            receivingOffice: 'RO1 - ORD', 
            doc_type: 'Invitation', 
            entryMode: 'Email', 
            documentDate: 'May 06, 2026 Wednesday', 
            receivedDate: 'May 07, 2026 Thursday', 
            nameOfParty: 'DIR. CORNELIA M. RILLERA', 
            notes: 'Civil Aviation Authority of the Philippines request for assistance providing a facilitator for the team building activity entitled "Waves of Unity Riding the Tide Together Indoors" on June 10-11, 2026, in Ilocos Norte', 
            signedBy: 'ROSITA G. TAMAYO, JR.', 
            enteredBy: 'ro1_ordadmin', 
            created_at: 'May 07, 2026 01:46pm Thursday' 
        })
    },
    // Captures the dynamic division string from the active modal workflow step
    selectedTargetDivision: {
        type: String,
        default: 'Unassigned Destination'
    }
});

// Explicit printing routine execution context
const triggerPrintJob = () => {
    if (typeof window !== 'undefined') {
        window.print();
    }
};
</script>

<template>
    <Head title="Transaction Snapshot" />

    <div class="p-4 bg-gray-100 min-h-screen font-sans flex flex-col items-center"> 
        <div class="half-a4-container bg-white border-2 border-black p-1 shadow-sm overflow-hidden flex flex-col justify-between"> 
             
            <div>
                <div class="flex border-b-2 border-black"> 
                    <div class="w-1/2 p-2 font-bold text-xs uppercase tracking-tight"> 
                        Daily Transaction (Snapshot) 
                    </div> 
                    <div class="w-1/2 p-2 text-right border-l-2 border-black"> 
                        <span class="font-bold text-[10px]">Doc No:</span>  
                        <span class="ml-2 font-mono text-sm">{{ request.docNo || 'PENDING' }}</span> 
                    </div> 
                </div> 

                <div class="grid grid-cols-2 border-b-2 border-black text-xs"> 
                    <div class="p-2 space-y-1 border-r-2 border-black"> 
                        <div class="flex"><span class="w-32 shrink-0">Receiving Office:</span> <span class="font-bold uppercase">{{ request.receivingOffice }}</span></div>
                        <div class="flex"><span class="w-32 shrink-0">Document Type:</span> <span class="font-bold text-[#0B2545]">{{ request.doc_type }}</span></div> 
                        <div class="flex"><span class="w-32 shrink-0">Document Date:</span> <span class="font-bold">{{ request.documentDate }}</span></div> 
                    </div> 
                    <div class="p-2 space-y-1"> 
                        <div class="flex"><span class="w-32 shrink-0">Destination:</span> <span class="font-black text-amber-700 uppercase">{{ selectedTargetDivision }}</span></div> 
                        <div class="flex"><span class="w-32 shrink-0">Entry Mode:</span> <span class="font-bold">{{ request.entryMode }}</span></div> 
                        <div class="flex"><span class="w-32 shrink-0">Received Date:</span> <span class="font-bold">{{ request.receivedDate }}</span></div> 
                    </div> 
                </div> 

                <div class="p-2 border-b-2 border-black space-y-2 text-xs"> 
                    <div class="flex"> 
                        <span class="w-32 shrink-0">Name of Party:</span>  
                        <span class="font-bold uppercase">{{ request.nameOfParty }}</span> 
                    </div> 
                    <div class="flex pb-1"> 
                        <span class="w-32 shrink-0">Document Details:</span>  
                        <span class="font-bold text-justify leading-tight flex-1 pr-1">{{ request.notes }}</span> 
                    </div> 
                     
                    <div class="flex pt-1 border-t border-gray-100"> 
                        <div class="w-1/2 flex items-center"> 
                            <span class="w-32 shrink-0">Signed By:</span> 
                            <span class="font-bold uppercase">{{ request.signedBy }}</span> 
                        </div> 
                        <div class="w-1/2 flex items-center"> 
                            <span class="w-24 shrink-0">Position:</span> 
                            <span class="font-bold border-b border-black flex-grow h-4"></span> 
                        </div> 
                    </div> 
                </div> 

                <div class="grid grid-cols-2 border-b-4 border-black text-[10px]"> 
                    <div class="p-2 flex items-center"> 
                        <span class="w-40">Entered/Updated By:</span> 
                        <span class="font-bold font-mono text-slate-700">{{ request.enteredBy }}</span> 
                    </div> 
                    <div class="p-2 flex items-center border-l-2 border-black"> 
                        <span class="w-32">Date Created:</span> 
                        <span class="font-bold font-mono text-slate-700">{{ request.created_at }}</span> 
                    </div> 
                </div> 

                <div class="grid grid-cols-2 min-h-[160px] text-[10px]"> 
                    <div class="p-2 space-y-2.5 border-r-2 border-black"> 
                        <div class="flex items-center"><span class="w-32">Date Due:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Date Received:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Action Required:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Accomplished:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Status:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                    </div> 
                    <div class="p-2 space-y-2.5"> 
                        <div class="flex items-center"><span class="w-32">Transaction No:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Current Office:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Action Person:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Next Office:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                        <div class="flex items-center"><span class="w-32">Action Taken:</span><div class="border-b border-gray-300 flex-grow h-3"></div></div> 
                    </div> 
                </div> 
            </div>

            <div class="grid grid-cols-2 border-t-2 border-black text-[9px] uppercase font-bold text-gray-400"> 
                <div class="p-1 min-h-[20px]">Updated By:</div> 
                <div class="p-1 border-l-2 border-black min-h-[20px]">Updated On:</div> 
            </div> 
        </div> 
         
        <div class="mt-6 no-print"> 
            <button @click="triggerPrintJob" class="bg-[#0B2545] hover:bg-black text-white px-8 py-3 rounded font-bold shadow-md transition text-xs uppercase tracking-wider"> 
                Print Half-A4 Page 
            </button> 
        </div> 
    </div> 
</template> 

<style scoped> 
/* A4 Portrait dimensions definition layout specs */ 
.half-a4-container { 
    width: 210mm; 
    height: 148.5mm; 
    box-sizing: border-box; 
} 

@media print { 
    @page { 
        size: A4 portrait; 
        margin: 0; 
    } 

    .no-print {  
        display: none !important;  
    } 

    body {  
        background: white;  
        margin: 0; 
        padding: 0; 
    } 

    .half-a4-container { 
        border: 2px solid black !important; 
        box-shadow: none !important; 
        width: 210mm !important; 
        height: 148.5mm !important; 
        margin: 0 !important; 
        padding: 4mm !important; 
        page-break-inside: avoid;
    } 
} 
</style>