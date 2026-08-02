import React, { useEffect } from 'react';
import { animate, stagger } from 'animejs';

export default function Blog({ articlesData = {} }) {
    const articles = articlesData.data || [];
    const pagination = {
        currentPage: articlesData.current_page || 1,
        lastPage: articlesData.last_page || 1,
        prevPageUrl: articlesData.prev_page_url,
        nextPageUrl: articlesData.next_page_url,
        total: articlesData.total || 0,
        links: articlesData.links || []
    };

    useEffect(() => {
        // Staggered card animation on load
        animate('.article-card', {
            opacity: [0, 1],
            translateY: [30, 0],
            delay: stagger(100),
            duration: 800,
            ease: 'outExpo'
        });
    }, [articlesData]);

    const handlePaginationClick = (url) => {
        if (!url) return;
        window.location.href = url;
    };

    return (
        <div className="bg-[#F3F2EE] min-h-screen pt-36 pb-24 font-sans">
            
            {/* Journal Header */}
            <div className="max-w-7xl mx-auto px-6 lg:px-12 mb-16 border-b border-[#3D5A47]/10 pb-16 relative overflow-hidden">
                <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-end relative z-10">
                    <div className="lg:col-span-8 space-y-6">
                        <div className="flex items-center gap-6">
                            <span className="text-[#3D5A47] text-[10px] font-bold uppercase tracking-[1.5em] block">DISPATCH_LOGS</span>
                            <div className="flex-grow h-px bg-[#3D5A47]/20"></div>
                        </div>
                        <h1 className="text-5xl md:text-7xl lg:text-[8rem] font-serif font-black leading-[0.8] text-[#1E2923]">
                            Altimeter <br/><span className="text-[#3D5A47] underline decoration-1 italic font-light font-serif">Logs.</span>
                        </h1>
                    </div>
                    <div className="lg:col-span-4 pb-4">
                        <p className="text-[#1E2923]/60 text-base md:text-lg font-medium leading-relaxed border-l-4 border-[#3D5A47] pl-8">
                            A curated chronicle of field observations, technical briefings, and ancestral mountain wisdom.
                        </p>
                    </div>
                </div>
            </div>

            <section className="max-w-7xl mx-auto px-6 lg:px-12">
                
                {/* Chronicle Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mb-16">
                    {articles.length > 0 ? (
                        articles.map((art) => (
                            <div 
                                key={art.id}
                                className="article-card opacity-0 group bg-white border border-stone-200 shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden flex flex-col justify-between"
                            >
                                <div>
                                    {/* Cover Image Wrapper */}
                                    <div className="aspect-[16/10] overflow-hidden relative grayscale contrast-125 group-hover:grayscale-0 transition-all duration-700">
                                        <div className="absolute inset-0 bg-[#1E2923]/20 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                                        <img 
                                            src={art.gambar_cover} 
                                            className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000"
                                            alt={art.judul}
                                        />
                                        <span className="absolute top-4 left-4 z-20 bg-[#3D5A47] text-white text-[8px] font-bold uppercase tracking-[0.3em] px-3.5 py-1.5 shadow-md">
                                            dispatch_
                                        </span>
                                    </div>
                                    
                                    <div className="p-8 space-y-4">
                                        {/* Category & Date */}
                                        <div className="flex items-center gap-3 text-[9px] font-bold uppercase tracking-widest text-[#3D5A47]/70">
                                            <span>{new Date(art.created_at).toLocaleDateString('en-US', {month: 'short', day: '2-digit', year: 'numeric'})}</span>
                                            <span className="w-1.5 h-1.5 rounded-full bg-[#3D5A47]/40"></span>
                                            <span>Field Log</span>
                                        </div>
                                        
                                        <h3 className="text-xl md:text-2xl font-serif italic text-[#1E2923] leading-snug">
                                            <a href={`/blog/${art.slug}`} className="hover:text-[#3D5A47] transition-colors relative inline-block">
                                                {art.judul}
                                            </a>
                                        </h3>

                                        <p className="text-stone-500 text-xs md:text-sm leading-relaxed line-clamp-3">
                                            {art.konten}
                                        </p>
                                    </div>
                                </div>
                                
                                {/* Signature */}
                                <div className="p-8 pt-0">
                                    <div className="pt-5 border-t border-stone-100 flex items-center justify-between">
                                        <div className="flex items-center gap-2">
                                            <div className="w-6 h-6 rounded-full bg-[#3D5A47]/5 flex items-center justify-center border border-[#3D5A47]/10">
                                                <span className="text-[8px] font-bold text-[#3D5A47]">PB</span>
                                            </div>
                                            <span className="text-[9px] font-bold uppercase tracking-widest text-[#1E2923]/60">Editorial Staff</span>
                                        </div>
                                        <a href={`/blog/${art.slug}`} className="text-[#3D5A47] text-[9px] font-bold uppercase tracking-wider hover:text-[#1E2923] transition-colors flex items-center gap-1">
                                            Read Log_ 
                                            <svg className="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2.5" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        ))
                    ) : (
                        <div className="col-span-full py-40 text-center border border-dashed border-stone-200 bg-white">
                            <span className="text-sm font-bold uppercase tracking-[0.5em] text-[#3D5A47]/40 animate-pulse">NO_LOGS_FOUND_IN_ARCHIVE</span>
                        </div>
                    )}
                </div>

                {/* Pagination Controls */}
                {pagination.lastPage > 1 && (
                    <div className="flex justify-center items-center gap-2 pb-24">
                        {pagination.links.map((link, idx) => {
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
