import React, { useState, useEffect } from 'react';
import { animate, stagger } from 'animejs';

export default function Explore({ tripsData = {}, searchParams = {} }) {
    const [layout, setLayout] = useState('grid'); // 'grid' or 'list'
    const [search, setSearch] = useState(searchParams.search || '');
    const [difficulty, setDifficulty] = useState(searchParams.difficulty || '');
    const [maxPrice, setMaxPrice] = useState(searchParams.max_price || '');

    const trips = tripsData.data || [];
    const pagination = {
        currentPage: tripsData.current_page || 1,
        lastPage: tripsData.last_page || 1,
        prevPageUrl: tripsData.prev_page_url,
        nextPageUrl: tripsData.next_page_url,
        total: tripsData.total || 0,
        links: tripsData.links || []
    };

    // Staggered card animation on load/layout change
    useEffect(() => {
        animate('.expedition-card', {
            opacity: [0, 1],
            translateY: [30, 0],
            delay: stagger(100),
            duration: 800,
            ease: 'outExpo'
        });
    }, [layout, tripsData]);

    const formatPrice = (price) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(price);
    };

    const handlePaginationClick = (url) => {
        if (!url) return;
        
        // Append current filters to the pagination url if not already there
        const destUrl = new URL(url, window.location.origin);
        if (search) destUrl.searchParams.set('search', search);
        if (difficulty) destUrl.searchParams.set('difficulty', difficulty);
        if (maxPrice) destUrl.searchParams.set('max_price', maxPrice);
        
        window.location.href = destUrl.toString();
    };

    return (
        <div className="bg-[#F3F2EE] min-h-screen pt-36 pb-24 font-sans">
            
            {/* Journal Header */}
            <div className="max-w-7xl mx-auto px-6 lg:px-12 mb-16 border-b border-[#3D5A47]/10 pb-16 relative overflow-hidden">
                <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-end relative z-10">
                    <div className="lg:col-span-8 space-y-6">
                        <div className="flex items-center gap-6">
                            <span className="text-[#3D5A47] text-[10px] font-bold uppercase tracking-[1.5em] block">COLLECTIVE_ARCHIVE</span>
                            <div className="flex-grow h-px bg-[#3D5A47]/20"></div>
                        </div>
                        <h1 className="text-5xl md:text-7xl lg:text-[8rem] font-serif font-black leading-[0.8] text-[#1E2923]">
                            Field <br/><span className="text-[#3D5A47] underline decoration-1 italic font-light font-serif">Journals.</span>
                        </h1>
                    </div>
                    <div className="lg:col-span-4 pb-4">
                        <p className="text-[#1E2923]/60 text-base md:text-lg font-medium leading-relaxed border-l-4 border-[#3D5A47] pl-8">
                            A curated repository of Indonesia's silent peaks. Each entry is a testament to the architectural soul of the wild.
                        </p>
                    </div>
                </div>
                <div className="absolute right-0 top-0 h-full w-full opacity-[0.03] pointer-events-none text-[25vw] font-serif italic text-[#3D5A47] flex items-center justify-end">
                    Journals
                </div>
            </div>

            <section className="max-w-7xl mx-auto px-6 lg:px-12">
                {/* Advanced Filter Panel */}
                <div className="bg-white/80 backdrop-blur-md p-8 md:p-10 border border-stone-200 mb-16 shadow-lg">
                    <form action="/explore" method="GET" className="grid grid-cols-1 md:grid-cols-12 gap-8 items-end">
                        
                        <div className="md:col-span-4 space-y-2">
                            <label className="text-[9px] font-bold uppercase tracking-[0.3em] text-[#3D5A47]">Identify Peak</label>
                            <input 
                                type="text" 
                                name="search" 
                                value={search} 
                                onChange={(e) => setSearch(e.target.value)}
                                placeholder="ENTER PEAK NAME..." 
                                className="w-full bg-transparent border-b border-stone-300 py-3 text-xs font-bold text-[#1E2923] uppercase tracking-[0.1em] outline-none focus:border-[#3D5A47] transition-colors"
                            />
                        </div>

                        <div className="md:col-span-3 space-y-2">
                            <label className="text-[9px] font-bold uppercase tracking-[0.3em] text-[#3D5A47]">Intensity Level</label>
                            <div className="relative">
                                <select 
                                    name="difficulty" 
                                    value={difficulty}
                                    onChange={(e) => setDifficulty(e.target.value)}
                                    className="w-full bg-transparent border-b border-stone-300 py-3 text-xs font-bold text-[#1E2923] uppercase tracking-[0.1em] outline-none focus:border-[#3D5A47] transition-colors cursor-pointer appearance-none"
                                >
                                    <option value="">ALL MODES</option>
                                    <option value="Pemula">BEGINNER PATH</option>
                                    <option value="Menengah">INTERMEDIATE LEVEL</option>
                                    <option value="Tinggi">ELITE DESCENT</option>
                                </select>
                                <div className="absolute right-2 bottom-3 pointer-events-none text-stone-400">▼</div>
                            </div>
                        </div>

                        <div className="md:col-span-3 space-y-2">
                            <label className="text-[9px] font-bold uppercase tracking-[0.3em] text-[#3D5A47]">Energy Investment</label>
                            <div className="relative">
                                <select 
                                    name="max_price" 
                                    value={maxPrice}
                                    onChange={(e) => setMaxPrice(e.target.value)}
                                    className="w-full bg-transparent border-b border-stone-300 py-3 text-xs font-bold text-[#1E2923] uppercase tracking-[0.1em] outline-none focus:border-[#3D5A47] transition-colors cursor-pointer appearance-none"
                                >
                                    <option value="">ALL BOUNDARIES</option>
                                    <option value="1000000">SUB 1M INVEST</option>
                                    <option value="2000000">SUB 2M INVEST</option>
                                    <option value="5000000">PREMIUM JOURNALS</option>
                                </select>
                                <div className="absolute right-2 bottom-3 pointer-events-none text-stone-400">▼</div>
                            </div>
                        </div>

                        <div className="md:col-span-2 flex gap-4">
                            <button 
                                type="submit" 
                                className="w-full bg-[#1E2923] text-white py-4.5 text-[10px] font-bold uppercase tracking-[0.4em] hover:bg-[#3D5A47] transition-all shadow-md"
                            >
                                Filter_
                            </button>
                        </div>
                    </form>
                </div>

                {/* Layout Grid / List Toggles */}
                <div className="flex justify-between items-center mb-10 text-[10px] font-bold uppercase text-[#1E2923]/60 tracking-wider">
                    <span>Showing {trips.length} of {pagination.total} peaks</span>
                    <div className="flex items-center gap-3">
                        <button 
                            onClick={() => setLayout('grid')}
                            className={`px-3 py-1.5 border ${layout === 'grid' ? 'bg-[#1E2923] text-white border-[#1E2923]' : 'bg-white text-stone-600 border-stone-200'}`}
                        >
                            Grid
                        </button>
                        <button 
                            onClick={() => setLayout('list')}
                            className={`px-3 py-1.5 border ${layout === 'list' ? 'bg-[#1E2923] text-white border-[#1E2923]' : 'bg-white text-stone-600 border-stone-200'}`}
                        >
                            List
                        </button>
                    </div>
                </div>

                {/* Journal Expedition List */}
                <div className={`grid gap-10 mb-20 ${layout === 'grid' ? 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3' : 'grid-cols-1'}`}>
                    {trips.length > 0 ? (
                        trips.map((trip) => (
                            <div 
                                key={trip.id}
                                className={`expedition-card opacity-0 bg-white border border-stone-200 shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden flex flex-col justify-between ${
                                    layout === 'list' ? 'lg:flex-row' : ''
                                }`}
                            >
                                <div className={`overflow-hidden relative bg-stone-100 ${
                                    layout === 'list' ? 'lg:w-[40%] aspect-[4/3] lg:aspect-auto' : 'aspect-[4/5]'
                                }`}>
                                    <img 
                                        src={trip.image_url} 
                                        className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000"
                                        alt={trip.nama_gunung}
                                    />
                                    
                                    <div className="absolute top-4 left-4 z-10 flex flex-col gap-2">
                                        <span className="bg-[#F3F2EE]/90 backdrop-blur-md border border-[#3D5A47]/10 px-2 py-1 text-[8px] font-bold uppercase tracking-widest text-[#1E2923] flex items-center gap-1.5">
                                            <span className="w-1 h-1 rounded-full bg-[#3D5A47] animate-pulse"></span>
                                            <span>Active Node</span>
                                        </span>
                                    </div>

                                    <div className="absolute bottom-4 right-4 z-10">
                                        <span className="bg-black/50 backdrop-blur-sm border border-white/10 px-2.5 py-1.5 text-[9px] font-bold uppercase tracking-widest text-white">
                                            {trip.ketinggian ? `${Number(trip.ketinggian).toLocaleString()}M ASL` : '3,142M ASL'}
                                        </span>
                                    </div>
                                </div>
                                
                                <div className={`p-8 space-y-6 flex-grow flex flex-col justify-between ${
                                    layout === 'list' ? 'lg:w-[60%]' : ''
                                }`}>
                                    <div className="space-y-4">
                                        <div className="flex justify-between items-center text-[10px] font-bold uppercase tracking-widest text-[#3D5A47]">
                                            <span>VECTOR_{trip.location.toUpperCase()}</span>
                                            <span className="flex items-center gap-2">
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
                                        
                                        <h3 className="text-2xl md:text-3xl font-serif italic font-black text-[#1E2923]">
                                            <a href={`/trips/${trip.slug}`} className="hover:text-[#3D5A47] transition-colors">
                                                {trip.nama_gunung}
                                            </a>
                                        </h3>
                                    </div>

                                    <div className="pt-6 border-t border-stone-100 flex justify-between items-end">
                                        <div className="space-y-1">
                                            <span className="text-[8px] font-bold text-gray-400 uppercase tracking-widest block">DEPARTURE</span>
                                            <span className="text-xs font-bold text-[#1E2923]">{new Date(trip.tanggal_berangkat).toLocaleDateString('en-US', {month: 'short', day: '2-digit', year: 'numeric'})}</span>
                                        </div>
                                        <div className="text-right space-y-1">
                                            <span className="text-[8px] font-bold text-gray-400 uppercase tracking-widest block">INVESTMENT</span>
                                            <span className="text-lg font-serif italic font-black text-[#1E2923]">
                                                {formatPrice(trip.harga)}
                                            </span>
                                        </div>
                                    </div>

                                    <div className="pt-6">
                                        <a href={`/trips/${trip.slug}`} className="block w-full border border-stone-200 py-3.5 text-center text-[10px] font-bold uppercase tracking-[0.3em] text-[#3D5A47] hover:bg-[#3D5A47] hover:text-white transition-all">
                                            Open Journal_
                                        </a>
                                    </div>
                                </div>
                            </div>
                        ))
                    ) : (
                        <div className="col-span-full py-40 text-center border border-dashed border-stone-200 bg-white">
                            <span className="text-sm font-bold uppercase tracking-[0.5em] text-[#3D5A47]/40 animate-pulse">NO_JOURNALS_FOUND_IN_ARCHIVE</span>
                        </div>
                    )}
                </div>

                {/* Pagination Controls */}
                {pagination.lastPage > 1 && (
                    <div className="flex justify-center items-center gap-2 pb-24">
                        {pagination.links.map((link, idx) => {
                            // Extract label (Prev, Next, numbers)
                            let label = link.label;
                            if (label.includes('Previous')) label = '←';
                            if (label.includes('Next')) label = '→';

                            return (
                                <button
                                    key={idx}
                                    disabled={!link.url}
                                    onClick={() => handlePaginationClick(link.url)}
                                    className={`px-5 py-3.5 border text-[10px] font-bold uppercase tracking-wider transition-all ${
                                        link.active 
                                            ? 'bg-[#1E2923] text-white border-[#1E2923]' 
                                            : link.url 
                                                ? 'bg-white hover:bg-[#3D5A47] hover:text-white border-stone-200 text-stone-600' 
                                                : 'bg-stone-100 text-stone-300 border-stone-200 cursor-not-allowed'
                                    }`}
                                >
                                    {label}
                                </button>
                            );
                        })}
                    </div>
                )}
            </section>
        </div>
    );
}
