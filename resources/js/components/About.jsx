import React, { useEffect } from 'react';
import { animate, stagger } from 'animejs';

export default function About() {
    useEffect(() => {
        // Stagger load elements
        animate('.about-animate', {
            opacity: [0, 1],
            translateY: [35, 0],
            delay: stagger(150),
            duration: 900,
            ease: 'outExpo'
        });
    }, []);

    return (
        <div className="bg-[#F3F2EE] min-h-screen font-sans">
            
            {/* Typographic Header */}
            <header className="bg-black text-white pt-40 pb-24 border-b border-white/10">
                <div className="max-w-7xl mx-auto px-6 lg:px-12">
                    <div className="grid grid-cols-1 md:grid-cols-12 gap-12 items-end">
                        <div className="md:col-span-8 space-y-6 about-animate opacity-0">
                            <span className="text-[10px] font-bold uppercase tracking-[0.5em] text-[#A8B5AA] block">The Operational Ethos</span>
                            <h1 className="text-5xl md:text-7xl lg:text-[8rem] font-serif font-black uppercase tracking-tight leading-[0.8]">
                                Identity<span className="text-[#3D5A47] underline decoration-1 italic font-light font-serif lowercase">.</span>
                            </h1>
                        </div>
                        <div className="md:col-span-4 pb-4 about-animate opacity-0">
                            <p className="text-gray-400 text-sm md:text-base font-medium leading-relaxed">
                                CV Puncak Bara Mandiri is a certified high-altitude expedition coordinator specializing in technical logistics and professional mountain guiding.
                            </p>
                        </div>
                    </div>
                </div>
            </header>

            {/* Main Identity Section */}
            <section className="py-24">
                <div className="max-w-7xl mx-auto px-6 lg:px-12 space-y-24">
                    
                    {/* Large Banner Image */}
                    <div className="relative h-[50vh] overflow-hidden shadow-2xl about-animate opacity-0">
                        <img 
                            src="https://images.unsplash.com/photo-1454496522488-7a8e488e8606?auto=format&fit=crop&w=1200&q=80" 
                            className="w-full h-full object-cover brightness-90" 
                            alt="Mountain Ascent"
                        />
                        <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div className="absolute bottom-10 left-10 text-white space-y-2 z-10">
                            <span className="text-[8px] font-bold uppercase tracking-[0.5em] text-[#A8B5AA]">FIELD_ARCHIVE_FILE_01</span>
                            <h3 className="text-2xl font-serif italic font-black uppercase tracking-tight">Ascending properly since 2020</h3>
                        </div>
                    </div>

                    {/* Bento Grid: The Pillars */}
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-12 about-animate opacity-0">
                        {/* Pillar 1 */}
                        <div className="bg-white p-10 md:p-12 space-y-8 border border-stone-200 hover:shadow-xl transition-all duration-500 group">
                            <div className="w-12 h-12 border border-black flex items-center justify-center group-hover:bg-[#3D5A47] group-hover:border-[#3D5A47] group-hover:text-white transition-all">
                                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div className="space-y-4">
                                <h3 className="text-xs font-bold uppercase tracking-[0.4em] text-[#3D5A47]">Professional APGI Guides</h3>
                                <p className="text-gray-500 text-sm leading-relaxed font-medium">
                                    Safety is not a feature; it is our primary protocol. All trip leaders are certified by the **APGI (Asosiasi Pemandu Gunung Indonesia)** and trained in wilderness first aid and high-altitude emergency sequences.
                                </p>
                            </div>
                        </div>

                        {/* Pillar 2 */}
                        <div className="bg-white p-10 md:p-12 space-y-8 border border-stone-200 hover:shadow-xl transition-all duration-500 group">
                            <div className="w-12 h-12 border border-black flex items-center justify-center group-hover:bg-[#3D5A47] group-hover:border-[#3D5A47] group-hover:text-white transition-all">
                                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </div>
                            <div className="space-y-4">
                                <h3 className="text-xs font-bold uppercase tracking-[0.4em] text-[#3D5A47]">Zero Waste Policy</h3>
                                <p className="text-gray-500 text-sm leading-relaxed font-medium">
                                    We operate under strict environmental boundaries. Every gram of logistics brought up the peak is documented, packed out, and verified at basecamp checkpoints to protect fragile volcanic ecosystems.
                                </p>
                            </div>
                        </div>
                    </div>

                    {/* Corporate Credentials */}
                    <div className="space-y-12 about-animate opacity-0">
                        <h2 className="text-3xl font-serif italic font-black uppercase tracking-tight border-b border-stone-200 pb-6 text-[#1E2923]">
                            Legalities & Affiliation
                        </h2>
                        
                        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">
                            <div className="bg-white p-10 md:p-12 space-y-8 border border-stone-200">
                                <span className="text-[9px] font-bold uppercase tracking-[0.4em] text-[#3D5A47]">Strategic Registry</span>
                                <div className="space-y-6">
                                    <div className="flex justify-between border-b border-stone-100 pb-4">
                                        <span className="text-xs font-bold text-gray-400 uppercase tracking-widest">Legal Name</span>
                                        <span className="text-xs font-black uppercase text-[#1E2923] tracking-wider">CV Puncak Bara Mandiri</span>
                                    </div>
                                    <div className="flex justify-between border-b border-stone-100 pb-4">
                                        <span className="text-xs font-bold text-gray-400 uppercase tracking-widest">TDUP License</span>
                                        <span className="text-xs font-black uppercase text-[#1E2923] tracking-wider">503/TDUP-WISATA/2026</span>
                                    </div>
                                    <div className="flex justify-between pb-2">
                                        <span className="text-xs font-bold text-gray-400 uppercase tracking-widest">Operational HQ</span>
                                        <span className="text-xs font-black uppercase text-[#1E2923] tracking-wider text-right">Jl. Rinjani Raya No. 45, Malang</span>
                                    </div>
                                </div>
                            </div>

                            <div className="bg-black text-white p-10 md:p-12 space-y-8 flex flex-col justify-between">
                                <div className="space-y-4">
                                    <span className="text-[9px] font-bold uppercase tracking-[0.5em] text-[#A8B5AA]">Authorized Partner</span>
                                    <h4 className="text-2xl font-serif italic font-black uppercase tracking-tight">National Park Permits</h4>
                                    <p className="text-gray-400 text-xs md:text-sm leading-relaxed font-medium">
                                        We maintain active administrative coordination with TNGGP (Gede Pangrango), TNBTS (Bromo Tengger Semeru), and TNGR (Rinjani) networks.
                                    </p>
                                </div>
                                <span className="text-[10px] font-bold uppercase tracking-[0.3em] text-[#A8B5AA]">Official Conservation Partner</span>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            {/* Call to Action: The Direct Line */}
            <section className="max-w-7xl mx-auto px-6 lg:px-12 py-20 about-animate opacity-0">
                <div className="bg-black text-white p-12 md:p-20 flex flex-col md:flex-row justify-between items-center gap-12 shadow-2xl">
                    <div className="space-y-4 text-center md:text-left">
                        <h2 className="text-4xl md:text-5xl font-serif italic font-black uppercase tracking-tight leading-none">Ready To Coordinate?</h2>
                        <p className="text-gray-400 text-sm font-medium tracking-wide">Our briefing team is standing by for your technical verification.</p>
                    </div>
                    <a 
                        href="https://wa.me/6281330012100" 
                        target="_blank" 
                        rel="noreferrer" 
                        className="bg-white text-black px-10 py-5 text-[11px] font-bold uppercase tracking-[0.5em] hover:bg-[#3D5A47] hover:text-white transition-all shadow-md shrink-0"
                    >
                        Initialize Protocol_
                    </a>
                </div>
            </section>
        </div>
    );
}
