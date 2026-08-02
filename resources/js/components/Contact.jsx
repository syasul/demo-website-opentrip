import React, { useEffect } from 'react';
import { animate, stagger } from 'animejs';

export default function Contact() {
    useEffect(() => {
        // Entry animation for grid elements
        animate('.contact-animate', {
            opacity: [0, 1],
            translateY: [30, 0],
            delay: stagger(120),
            duration: 850,
            ease: 'outExpo'
        });
    }, []);

    return (
        <div className="bg-[#F3F2EE] min-h-screen font-sans">
            
            {/* Typographic Header */}
            <header className="bg-black text-white pt-40 pb-24 border-b border-white/10">
                <div className="max-w-7xl mx-auto px-6 lg:px-12">
                    <div className="grid grid-cols-1 md:grid-cols-12 gap-12 items-end">
                        <div className="md:col-span-8 space-y-6 contact-animate opacity-0">
                            <span className="text-[10px] font-bold uppercase tracking-[0.5em] text-[#A8B5AA] block">The Inquiry Protocol</span>
                            <h1 className="text-5xl md:text-7xl lg:text-[8rem] font-serif font-black uppercase tracking-tight leading-[0.8]">
                                Connect<span className="text-[#3D5A47] underline decoration-1 italic font-light font-serif lowercase">.</span>
                            </h1>
                        </div>
                        <div className="md:col-span-4 pb-4 contact-animate opacity-0">
                            <p className="text-gray-400 text-sm md:text-base font-medium leading-relaxed">
                                Direct communication channels established for logistical coordination, technical inquiries, and project partnerships.
                            </p>
                        </div>
                    </div>
                </div>
            </header>

            <section className="max-w-7xl mx-auto px-6 lg:px-12 py-24">
                
                {/* Channel Grid: Architectural Bento */}
                <div className="grid grid-cols-1 md:grid-cols-3 gap-px bg-stone-200 border border-stone-200 contact-animate opacity-0">
                    
                    {/* Card 1 */}
                    <div className="p-10 md:p-12 space-y-8 hover:bg-stone-50 transition-colors group bg-white">
                        <div className="w-12 h-12 border border-black flex items-center justify-center group-hover:bg-[#3D5A47] group-hover:border-[#3D5A47] group-hover:text-white transition-all">
                            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L23 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div className="space-y-4">
                            <h3 className="text-[10px] font-bold uppercase tracking-[0.4em] text-[#3D5A47]">Official Liaison</h3>
                            <p className="text-lg font-bold truncate text-[#1E2923]">independenttendiyvisual@gmail.com</p>
                            <p className="text-gray-400 text-xs font-medium leading-relaxed">For project briefings, technical documentation, and partnership requests.</p>
                        </div>
                        <a href="mailto:independenttendiyvisual@gmail.com" className="inline-block border-b border-black pb-1 text-[10px] font-bold uppercase tracking-[0.3em] hover:text-[#3D5A47] hover:border-[#3D5A47] transition-all">
                            Transmit Email_
                        </a>
                    </div>

                    {/* Card 2 */}
                    <div className="p-10 md:p-12 space-y-8 hover:bg-stone-50 transition-colors group bg-white">
                        <div className="w-12 h-12 border border-black flex items-center justify-center group-hover:bg-[#3D5A47] group-hover:border-[#3D5A47] group-hover:text-white transition-all">
                            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div className="space-y-4">
                            <h3 className="text-[10px] font-bold uppercase tracking-[0.4em] text-[#3D5A47]">Physical Hub</h3>
                            <p className="text-xl font-serif italic font-black text-[#1E2923]">SANFORD OPS.</p>
                            <p className="text-gray-400 text-xs font-medium leading-relaxed">Strategic headquarters for route planning and technical equipment verification.</p>
                        </div>
                        <span className="text-[10px] font-bold uppercase tracking-[0.3em] text-[#3D5A47]">Location: Malang, East Java</span>
                    </div>

                    {/* Card 3 */}
                    <div className="p-10 md:p-12 space-y-8 hover:bg-stone-50 transition-colors group bg-white">
                        <div className="w-12 h-12 border border-black flex items-center justify-center group-hover:bg-[#3D5A47] group-hover:border-[#3D5A47] group-hover:text-white transition-all">
                            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div className="space-y-4">
                            <h3 className="text-[10px] font-bold uppercase tracking-[0.4em] text-[#3D5A47]">Direct Hotline</h3>
                            <p className="text-lg font-bold truncate text-[#1E2923]">0813-3001-2100</p>
                            <p className="text-gray-400 text-xs font-medium leading-relaxed">For quick updates on logistics, schedule adjustment, and field operations.</p>
                        </div>
                        <a 
                            href="https://wa.me/6281330012100" 
                            target="_blank" 
                            rel="noreferrer" 
                            className="inline-block border-b border-black pb-1 text-[10px] font-bold uppercase tracking-[0.3em] hover:text-[#3D5A47] hover:border-[#3D5A47] transition-all"
                        >
                            Contact WhatsApp_
                        </a>
                    </div>
                </div>

                {/* FAQ Protocol: Analytical Breakdown */}
                <div className="mt-32 space-y-16 contact-animate opacity-0">
                    <div className="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 border-b border-stone-200 pb-8">
                        <h2 className="text-4xl md:text-5xl font-serif italic font-black uppercase text-[#1E2923] tracking-tight">
                            Support Protocol<span className="text-[#3D5A47] underline decoration-1">.</span>
                        </h2>
                        <p className="text-gray-400 text-xs font-bold tracking-widest uppercase">Frequently Referenced Information</p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-12">
                        {[
                            {
                                num: '01_',
                                q: 'Eligibility For Beginners',
                                a: 'All participants are welcome. We curate specific expeditions categorized under "Pemula" (Beginner) to ensure controlled progression and professional guidance for first-time ascents.'
                            },
                            {
                                num: '02_',
                                q: 'Logistical Inventory',
                                a: 'Core infrastructure (dome tents, air mattresses, sleeping bags, culinary equipment) is managed by the Sanford team. Participants are only required to maintain technical personal apparel and specific medication.'
                            },
                            {
                                num: '03_',
                                q: 'Cancellation Sequence',
                                a: 'Financial recovery protocols allow for 50% refund at H-14. Below H-7, resource allocation is finalized. Personnel substitution is permitted up to H-3 without investigative penalties.'
                            },
                            {
                                num: '04_',
                                q: 'Porter Allocation',
                                a: 'Standardized porter support covers communal logistics and structural equipment. Personal load management (carrier/gear) remains the responsibility of the individual unless a private tactical porter is requested at H-3.'
                            }
                        ].map((faq, index) => (
                            <div key={index} className="space-y-3 pb-8 border-b border-stone-200">
                                <h4 className="text-sm font-bold uppercase tracking-wider flex items-center gap-3 text-[#1E2923]">
                                    <span className="text-[#3D5A47]">{faq.num}</span> {faq.q}
                                </h4>
                                <p className="text-gray-500 text-sm leading-relaxed font-medium">
                                    {faq.a}
                                </p>
                            </div>
                        ))}
                    </div>
                </div>

                {/* Call to Action: The Direct Line */}
                <div className="mt-32 bg-black text-white p-12 md:p-20 flex flex-col md:flex-row justify-between items-center gap-12 shadow-2xl contact-animate opacity-0">
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
