import React from 'react';

export default function Footer() {
    return (
        <footer className="bg-black text-white pt-24 pb-16 relative overflow-hidden">
            <div className="absolute inset-0 opacity-[0.02] pointer-events-none" style={{ backgroundImage: "url('https://www.transparenttextures.com/patterns/carbon-fibre.png')" }}></div>
            <div className="max-w-7xl mx-auto px-6 relative z-10">
                <div className="grid grid-cols-1 lg:grid-cols-12 gap-16 pb-20 border-b border-white/10">
                    <div className="lg:col-span-6 space-y-10">
                        <div className="space-y-4">
                            <span className="text-[10px] font-bold uppercase tracking-[0.5em] text-[#A8B5AA]">THE MANIFESTO</span>
                            <h2 className="text-4xl md:text-6xl font-serif font-black tracking-tight leading-tight uppercase">
                                Architects of <br/>
                                <span className="italic font-light lowercase tracking-normal font-serif text-[#A8B5AA]">high-altitude</span> <br/>
                                experience.
                            </h2>
                        </div>
                        <div className="flex flex-col md:flex-row gap-10 items-start md:items-center">
                            <div className="space-y-2">
                                <span className="text-[9px] font-bold text-gray-500 uppercase tracking-[0.3em]">Direct Channel</span>
                                <p className="text-lg font-bold tracking-tight text-[#A8B5AA]">0813 3001 2100</p>
                            </div>
                            <div className="w-px h-10 bg-white/15 hidden md:block"></div>
                            <div className="flex gap-6">
                                <a href="https://instagram.com" target="_blank" rel="noreferrer" className="text-[10px] font-bold uppercase tracking-[0.3em] hover:text-[#A8B5AA] transition-colors">
                                    Instagram
                                </a>
                                <a href="https://youtube.com" target="_blank" rel="noreferrer" className="text-[10px] font-bold uppercase tracking-[0.3em] hover:text-[#A8B5AA] transition-colors">
                                    Youtube
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div className="lg:col-span-3 space-y-8">
                        <h4 className="text-[10px] font-bold uppercase tracking-[0.5em] text-gray-400">Navigation</h4>
                        <ul className="space-y-3 text-[11px] font-medium uppercase tracking-[0.2em]">
                            <li><a href="/explore" className="hover:text-[#A8B5AA] transition-colors">The Expeditions</a></li>
                            <li><a href="/blog" className="hover:text-[#A8B5AA] transition-colors">The Logbook</a></li>
                            <li><a href="/about" className="hover:text-[#A8B5AA] transition-colors">The Identity</a></li>
                            <li><a href="/contact" className="hover:text-[#A8B5AA] transition-colors">Contact Protocol</a></li>
                        </ul>
                    </div>

                    <div className="lg:col-span-3 space-y-8">
                        <h4 className="text-[10px] font-bold uppercase tracking-[0.5em] text-gray-400">Logistics Inquiry</h4>
                        <p className="text-[12px] text-gray-400 leading-relaxed font-medium">
                            For custom bookings, technical briefings, or community expedition inquiries, reach out directly to the Sanford Nature Collective coordinates.
                        </p>
                        <div className="pt-4 border-t border-white/10 flex items-center gap-4">
                            <img src="/images/logo_light.png" alt="Sanford Logo" className="h-10 w-auto object-contain" />
                            <span className="text-[9px] font-bold text-[#A8B5AA] uppercase tracking-[0.5em]">SANFORD ARCHIVES</span>
                        </div>
                    </div>
                </div>
                
                <div className="pt-12 flex flex-col md:flex-row justify-between items-center gap-8">
                    <div className="flex flex-col gap-1 text-center md:text-left">
                        <span className="text-[10px] font-medium text-gray-500 uppercase tracking-[0.3em]">
                            &copy; {new Date().getFullYear()} PUNCAK & BARA. ALL RIGHTS RESERVED.
                        </span>
                        <span className="text-[8px] font-bold text-gray-600 uppercase tracking-[0.4em]">
                            EST. 2024 / INDONESIA
                        </span>
                    </div>
                    
                    <div className="flex items-center gap-4 text-right">
                        <span className="text-[9px] font-bold text-gray-500 uppercase tracking-[0.3em]">Handcrafted by</span>
                        <span className="text-xs font-bold uppercase tracking-widest text-[#A8B5AA]">INXDVI</span>
                    </div>
                </div>
            </div>
        </footer>
    );
}
