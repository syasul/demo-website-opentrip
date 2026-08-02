import React, { useEffect } from 'react';
import { animate, stagger } from 'animejs';

export default function BlogDetail({ article = {}, otherArticles = [] }) {
    useEffect(() => {
        // Stagger load elements
        animate('.detail-animate', {
            opacity: [0, 1],
            translateY: [30, 0],
            delay: stagger(120),
            duration: 850,
            ease: 'outExpo'
        });
    }, [article]);

    return (
        <div className="bg-[#F3F2EE] min-h-screen pt-36 pb-24 font-sans">
            <article className="max-w-7xl mx-auto px-6 lg:px-12">
                
                {/* Chronicle Header */}
                <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-end mb-16 detail-animate opacity-0">
                    <div className="lg:col-span-8 space-y-6">
                        <div className="flex items-center gap-6">
                            <span className="text-[#3D5A47] text-[10px] font-bold uppercase tracking-[1.5em] block">DISPATCH_DETAIL_V1</span>
                            <div className="flex-grow h-px bg-[#3D5A47]/20"></div>
                        </div>
                        <h1 className="text-4xl md:text-6xl lg:text-7xl font-serif italic text-[#1E2923] leading-tight">
                            {article.judul}
                        </h1>
                        <div className="flex items-center gap-6 text-[10px] font-bold uppercase tracking-widest text-[#1E2923]/60">
                            <span>{new Date(article.created_at).toLocaleDateString('en-US', {month: 'short', day: '2-digit', year: 'numeric'})}</span>
                            <span>•</span>
                            <span>By {article.author?.name || 'Editorial Staff'}</span>
                        </div>
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-20">
                    {/* Featured Image */}
                    <div className="lg:col-span-12 h-[50vh] md:h-[60vh] overflow-hidden shadow-2xl detail-animate opacity-0">
                        <img 
                            src={article.gambar_cover} 
                            className="w-full h-full object-cover brightness-95"
                            alt={article.judul}
                        />
                    </div>

                    {/* Narrative Content */}
                    <div className="lg:col-span-8 space-y-12 detail-animate opacity-0">
                        <div className="prose prose-lg max-w-none text-[#1E2923]/80 leading-relaxed font-medium">
                            <p className="whitespace-pre-line text-stone-700">
                                {article.konten}
                            </p>
                        </div>

                        <div className="pt-8 border-t border-stone-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                            <span className="text-[10px] font-bold uppercase tracking-widest text-stone-400">SECURE_DISPATCH_PROTOCOL</span>
                            <a 
                                href={`https://wa.me/?text=${encodeURIComponent(article.judul + ' - ' + window.location.href)}`} 
                                target="_blank" 
                                rel="noreferrer" 
                                className="bg-[#3D5A47] text-white px-8 py-4 text-[10px] font-bold uppercase tracking-[0.4em] hover:bg-[#1E2923] transition-all flex items-center gap-3 shadow-md"
                            >
                                Share Dispatch_
                                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8.684 10.742l4.828-2.414m0 0a3 3 0 100-1.417L8.684 9.258m0 0a3 3 0 100 1.417M8.684 10.742L12 12l.684-.342m0 0l4.828 2.414m0 0a3 3 0 100 1.417L12 12.684" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    {/* Sidebar Chronicles */}
                    <div className="lg:col-span-4 detail-animate opacity-0">
                        <aside className="sticky top-32 space-y-12">
                            <div className="bg-white/80 backdrop-blur-md p-8 border border-stone-200 shadow-md space-y-8">
                                <h4 className="text-xs font-bold text-[#3D5A47] uppercase tracking-[0.4em] border-b border-stone-200 pb-4">
                                    Latest Entries
                                </h4>
                                <div className="space-y-6">
                                    {otherArticles && otherArticles.length > 0 ? (
                                        otherArticles.map((oArt) => (
                                            <div key={oArt.id} className="space-y-1">
                                                <h5 className="text-sm font-serif italic text-[#1E2923] hover:text-[#3D5A47] transition-colors leading-snug">
                                                    <a href={`/blog/${oArt.slug}`}>{oArt.judul}</a>
                                                </h5>
                                                <span className="text-[9px] font-bold text-stone-400 uppercase tracking-widest block">
                                                    {new Date(oArt.created_at).toLocaleDateString('en-US', {month: 'short', day: '2-digit', year: 'numeric'})}
                                                </span>
                                            </div>
                                        ))
                                    ) : (
                                        <p className="text-[10px] font-bold text-stone-300 uppercase">NO OTHER LOGS</p>
                                    )}
                                </div>
                                
                                <div className="pt-6 border-t border-stone-200 text-center">
                                    <a 
                                        href="/blog" 
                                        className="text-[10px] font-bold text-[#3D5A47] uppercase tracking-widest hover:underline flex items-center justify-center gap-2"
                                    >
                                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2.5" d="M15 19l-7-7 7-7" />
                                        </svg>
                                        Return to Archives
                                    </a>
                                </div>
                            </div>
                        </aside>
                    </div>

                </div>
            </article>
        </div>
    );
}
