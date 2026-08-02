import React, { useState, useEffect } from 'react';
import { animate, stagger } from 'animejs';

export default function Detail({ trip = {}, otherTrips = [], approvedReviews = [], auth = {}, routes = {} }) {
    const [activeTab, setActiveTab] = useState('deskripsi');

    useEffect(() => {
        // Entry animation for header details
        animate('.detail-header-element', {
            opacity: [0, 1],
            translateY: [30, 0],
            delay: stagger(120),
            duration: 800,
            ease: 'outQuad'
        });
    }, []);

    // Animate tab switching
    useEffect(() => {
        animate(`#tab-content-${activeTab}`, {
            opacity: [0, 1],
            translateY: [15, 0],
            duration: 500,
            ease: 'outQuad'
        });
    }, [activeTab]);

    const formatPrice = (price) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(price);
    };

    const quotaPercentage = ((trip.kuota - trip.sisa_kuota) / trip.kuota) * 100;

    // Diff in days between berangkat and pulang
    const diffDays = Math.ceil(Math.abs(new Date(trip.tanggal_pulang) - new Date(trip.tanggal_berangkat)) / (1000 * 60 * 60 * 24));

    return (
        <div className="bg-[#F3F2EE] pb-32 font-sans">
            
            {/* Journal Entry Header */}
            <header className="relative min-h-[90vh] flex flex-col justify-end pt-32 pb-16">
                <div className="absolute inset-0 z-0">
                    <img 
                        src={trip.image_url} 
                        className="w-full h-full object-cover brightness-75"
                        alt={trip.nama_gunung}
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-[#F3F2EE] via-transparent to-black/30"></div>
                </div>

                <div className="max-w-7xl mx-auto px-6 lg:px-12 relative z-10 w-full">
                    <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-end">
                        <div className="lg:col-span-8 space-y-6 detail-header-element opacity-0">
                            <div className="flex items-center gap-6">
                                <span className="text-white text-[10px] font-bold uppercase tracking-[1.5em] block">MOUNT_SPEC_ARCHIVE</span>
                                <div className="flex-grow h-px bg-white/20"></div>
                            </div>
                            <h1 className="text-4xl md:text-6xl lg:text-[6.5rem] font-serif font-black leading-[0.95] tracking-tight text-[#1E2923] break-words">
                                {trip.nama_gunung}<span className="text-[#3D5A47] underline decoration-1 italic font-light">.</span>
                            </h1>
                        </div>
                        
                        <div className="lg:col-span-4 bg-[#F3F2EE]/90 backdrop-blur-md p-8 border border-stone-200 shadow-xl space-y-8 detail-header-element opacity-0">
                            <div className="relative">
                                {/* Live Indicator */}
                                <div className="absolute top-0 right-0 flex items-center gap-2 bg-emerald-500/10 px-3 py-1 border border-emerald-500/20">
                                    <span className="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span className="text-[8px] font-bold uppercase tracking-widest text-emerald-700">active_node</span>
                                </div>

                                <div className="space-y-2 pt-6">
                                    <span className="text-[9px] font-bold uppercase tracking-[0.25em] text-[#3D5A47] block">CURRENT_VALUATION</span>
                                    <span className="text-3xl lg:text-4xl font-serif font-black text-[#1E2923] italic">
                                        {formatPrice(trip.harga)}
                                    </span>
                                </div>
                            </div>
                            
                            <div className="grid grid-cols-2 gap-8 pt-6 border-t border-stone-200">
                                <div className="space-y-1">
                                    <span className="text-[8px] font-bold uppercase tracking-widest text-[#1E2923]/40">STABILITY_LV</span>
                                    <span className="text-xs font-bold text-[#1E2923] uppercase tracking-widest flex items-center gap-2">
                                        <span className={`w-1.5 h-1.5 rounded-full ${
                                            String(trip.level_kesulitan).toLowerCase() === 'easy' 
                                                ? 'bg-emerald-500' 
                                                : String(trip.level_kesulitan).toLowerCase() === 'medium' 
                                                    ? 'bg-amber-500' 
                                                    : 'bg-red-500'
                                        }`}></span>
                                        {trip.level_kesulitan}
                                    </span>
                                </div>
                                <div className="space-y-1 text-right">
                                    <span className="text-[8px] font-bold uppercase tracking-widest text-[#1E2923]/40">ELEVATION</span>
                                    <span className="text-xs font-bold text-[#1E2923] uppercase tracking-widest">
                                        {trip.ketinggian ? `${Number(trip.ketinggian).toLocaleString()}M ASL` : '3,676M ASL'}
                                    </span>
                                </div>
                            </div>
                            <a href={`/booking/${trip.slug}`} className="block w-full bg-[#3D5A47] text-white text-center py-4.5 text-[10px] font-bold uppercase tracking-[0.4em] hover:bg-[#1E2923] transition-all shadow-md">
                                Initiate Journey_
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            {/* Main Tabs and Description */}
            <main className="max-w-7xl mx-auto px-6 lg:px-12 py-24">
                <div className="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24">
                    
                    {/* Tab Pane */}
                    <div className="lg:col-span-8 space-y-16">
                        <nav className="flex items-center gap-8 border-b border-stone-200 overflow-x-auto pb-px">
                            {[
                                { key: 'deskripsi', label: '[ 01 ] Briefing_' },
                                { key: 'itinerary', label: '[ 02 ] Logbook_' },
                                { key: 'ulasan', label: '[ 03 ] Final_Words_' }
                            ].map(tab => (
                                <button 
                                    key={tab.key}
                                    onClick={() => setActiveTab(tab.key)} 
                                    className={`relative pb-6 text-[10px] font-bold uppercase tracking-[0.3em] transition-all whitespace-nowrap ${
                                        activeTab === tab.key 
                                            ? 'text-[#3D5A47] border-b-2 border-[#3D5A47]' 
                                            : 'text-stone-400 hover:text-[#1E2923]'
                                    }`}
                                >
                                    {tab.label}
                                </button>
                            ))}
                        </nav>

                        {/* Tab Contents: Briefing */}
                        {activeTab === 'deskripsi' && (
                            <div id="tab-content-deskripsi" className="space-y-12">
                                <div className="prose max-w-none">
                                    <p className="text-[#1E2923]/80 text-lg sm:text-xl leading-relaxed italic font-serif border-l-4 border-[#3D5A47] pl-6 py-3 bg-[#3D5A47]/5">
                                        "{trip.deskripsi}"
                                    </p>
                                </div>

                                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div className="bg-white p-8 space-y-6 border border-stone-200 shadow-sm">
                                        <div className="flex items-center gap-4">
                                            <div className="w-1 h-8 bg-[#3D5A47]"></div>
                                            <h4 className="text-[10px] font-bold text-[#1E2923] uppercase tracking-[0.3em]">Integrated Logistics</h4>
                                        </div>
                                        <ul className="space-y-3">
                                            {(trip.what_is_included || ['Professional Guides', 'Entry Permits', 'Nature Gear Kit', 'High-Altitude Nutrition']).map((inc, i) => (
                                                <li key={i} className="text-xs font-bold uppercase tracking-wider text-stone-500 flex items-center gap-3">
                                                    <svg className="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2.5" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    {inc}
                                                </li>
                                            ))}
                                        </ul>
                                    </div>
                                    <div className="bg-[#1E2923] p-8 space-y-6 shadow-xl relative overflow-hidden">
                                        <div className="flex items-center gap-4">
                                            <div className="w-1 h-8 bg-[#3D5A47]"></div>
                                            <h4 className="text-[10px] font-bold text-white uppercase tracking-[0.3em]">Field Requirements</h4>
                                        </div>
                                        <ul className="space-y-3">
                                            {[
                                                'CLIMATE-READY SHELL',
                                                'ARCH-SUPPORT FOOTWEAR',
                                                'HYDRATION_SYSTEM_3L'
                                            ].map((req, i) => (
                                                <li key={i} className="text-xs font-bold uppercase tracking-wider text-[#A8B5AA] flex items-center gap-3">
                                                    <svg className="w-4 h-4 text-[#3D5A47] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                    </svg>
                                                    {req}
                                                </li>
                                            ))}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        )}

                        {/* Tab Contents: Logbook / Itinerary */}
                        {activeTab === 'itinerary' && (
                            <div id="tab-content-itinerary" className="space-y-0">
                                {trip.itinerary && trip.itinerary.length > 0 ? (
                                    trip.itinerary.map((it, idx) => (
                                        <div key={idx} className="flex gap-6 group">
                                            <div className="flex flex-col items-center shrink-0">
                                                <div className="w-8 h-8 rounded-full border border-[#3D5A47] bg-[#F3F2EE] flex items-center justify-center group-hover:bg-[#3D5A47] group-hover:text-white transition-colors duration-300 shadow-sm z-10">
                                                    <span className="text-[9px] font-bold">0{idx + 1}</span>
                                                </div>
                                                {idx < trip.itinerary.length - 1 && (
                                                    <div className="w-px flex-grow border-l border-dashed border-[#3D5A47]/30 my-2"></div>
                                                )}
                                            </div>
                                            <div className="pb-10 space-y-1.5 pt-1">
                                                <span className="text-[8px] font-bold text-[#3D5A47] uppercase tracking-[0.25em] block">PROTOCOL_STAGE_0{idx + 1}</span>
                                                <p className="text-[#1E2923]/70 text-sm leading-relaxed font-medium">
                                                    {it}
                                                </p>
                                            </div>
                                        </div>
                                    ))
                                ) : (
                                    <div className="py-20 text-center border border-dashed border-stone-300 bg-white">
                                        <span className="text-xs font-bold uppercase tracking-[0.5em] text-[#3D5A47]/40">LOGBOOK_NOT_YET_ARCHIVED</span>
                                    </div>
                                )}
                            </div>
                        )}

                        {/* Tab Contents: Reviews / Final Words */}
                        {activeTab === 'ulasan' && (
                            <div id="tab-content-ulasan" className="space-y-8">
                                {approvedReviews && approvedReviews.length > 0 ? (
                                    approvedReviews.map((rev) => (
                                        <div 
                                            key={rev.id} 
                                            className="bg-white border border-stone-200 p-8 shadow-sm space-y-6 relative overflow-hidden group hover:shadow-lg transition-all duration-300"
                                        >
                                            <div className="absolute right-6 top-6 opacity-[0.03] group-hover:opacity-[0.06] transition-opacity">
                                                <svg className="w-16 h-16 text-[#3D5A47]" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                                </svg>
                                            </div>
                                            <div className="flex items-center gap-4 relative z-10">
                                                <div className="w-10 h-10 bg-[#3D5A47] text-white flex items-center justify-center text-xs font-bold rounded-full uppercase tracking-wider">
                                                    {String(rev.user?.name || 'US').substring(0, 2).toUpperCase()}
                                                </div>
                                                <div className="space-y-0.5">
                                                    <span className="text-xs font-bold text-[#1E2923] uppercase tracking-[0.1em] block">
                                                        {rev.user?.name || 'Anonymous User'}
                                                    </span>
                                                    <div className="flex text-amber-500 gap-0.5">
                                                        {Array.from({ length: rev.rating || 5 }).map((_, i) => (
                                                            <svg key={i} className="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                                            </svg>
                                                        ))}
                                                    </div>
                                                </div>
                                            </div>
                                            <p className="text-[#1E2923]/80 text-lg font-serif italic leading-relaxed relative z-10 pl-4 border-l-2 border-[#3D5A47]/30">
                                                "{rev.komentar}"
                                            </p>
                                        </div>
                                    ))
                                ) : (
                                    <div className="py-20 text-center border border-dashed border-stone-300 bg-white">
                                        <span className="text-xs font-bold uppercase tracking-[0.5em] text-[#3D5A47]/40">NO_FINAL_WORDS_LOGGED</span>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>

                    {/* Sidebar Resources */}
                    <div className="lg:col-span-4">
                        <aside className="sticky top-32 space-y-8">
                            <div className="bg-[#F3F2EE]/90 backdrop-blur-md p-8 border border-stone-200 shadow-md space-y-8">
                                <div className="space-y-4">
                                    <div className="flex justify-between items-center text-[9px] font-bold uppercase tracking-widest text-[#3D5A47]">
                                        <span>REMAINING SEATS</span>
                                        <span className="bg-[#3D5A47]/10 px-2.5 py-0.5 border border-[#3D5A47]/20">
                                            {trip.sisa_kuota} LEFT
                                        </span>
                                    </div>
                                    <div className="w-full h-1.5 bg-stone-200 overflow-hidden">
                                        <div className="h-full bg-[#3D5A47]" style={{ width: `${quotaPercentage}%` }}></div>
                                    </div>
                                </div>
                                
                                <div className="space-y-3 pt-6 border-t border-stone-200 text-[10px] font-bold uppercase tracking-wider">
                                    <div className="flex justify-between items-center">
                                        <span className="text-[#1E2923]/50 italic">Departure Node</span>
                                        <span className="text-[#1E2923]">
                                            {new Date(trip.tanggal_berangkat).toLocaleDateString('en-US', {month: 'short', day: '2-digit', year: 'numeric'})}
                                        </span>
                                    </div>
                                    <div className="flex justify-between items-center">
                                        <span className="text-[#1E2923]/50 italic">Duration Calc</span>
                                        <span className="text-[#1E2923]">{diffDays} Days</span>
                                    </div>
                                </div>

                                <a href={`/booking/${trip.slug}`} className="block w-full bg-[#3D5A47] text-white text-center py-4.5 text-[10px] font-bold uppercase tracking-[0.4em] hover:bg-[#1E2923] transition-all shadow-md">
                                    Confirm Registration_
                                </a>
                            </div>
                        </aside>
                    </div>

                </div>
            </main>
        </div>
    );
}
