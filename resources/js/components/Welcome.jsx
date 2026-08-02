import React, { useEffect, useRef } from 'react';
import { animate, stagger } from 'animejs';

export default function Welcome({ trips = [], reviews = [], articles = [], auth = {}, routes = {} }) {
    const heroRef = useRef(null);
    const ethosRef = useRef(null);
    const peaksRef = useRef(null);

    useEffect(() => {
        // Hero Section Entry Animation
        animate('.hero-element', {
            opacity: [0, 1],
            translateY: [40, 0],
            delay: stagger(150),
            duration: 1000,
            ease: 'outExpo'
        });

        animate('.hero-image-container', {
            opacity: [0, 1],
            scale: [0.95, 1],
            delay: 400,
            duration: 1200,
            ease: 'outExpo'
        });

        // Setup scroll animation for ethos using IntersectionObserver
        const observerOptions = {
            threshold: 0.1
        };

        const ethosObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animate('.ethos-card', {
                        opacity: [0, 1],
                        translateY: [30, 0],
                        delay: stagger(120),
                        duration: 800,
                        ease: 'outQuad'
                    });
                    ethosObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        if (ethosRef.current) ethosObserver.observe(ethosRef.current);

        const peaksObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animate('.peak-card', {
                        opacity: [0, 1],
                        translateY: [45, 0],
                        delay: stagger(150),
                        duration: 1000,
                        ease: 'outExpo'
                    });
                    peaksObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        if (peaksRef.current) peaksObserver.observe(peaksRef.current);

        return () => {
            ethosObserver.disconnect();
            peaksObserver.disconnect();
        };
    }, []);

    // Format currency
    const formatPrice = (price) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(price);
    };

    return (
        <div className="relative w-full bg-[#F3F2EE] min-h-screen pt-24 overflow-x-hidden font-sans">
            {/* Topography Matrix Background */}
            <div className="absolute inset-0 z-0 pointer-events-none opacity-[0.03]" style={{ backgroundImage: "url('https://www.transparenttextures.com/patterns/carbon-fibre.png')" }}></div>

            {/* Nature Hero Split */}
            <section ref={heroRef} className="relative min-h-[90vh] flex flex-col justify-center px-6 lg:px-24 py-16 overflow-hidden">
                <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center max-w-7xl mx-auto w-full">

                    <div className="lg:col-span-6 space-y-8 relative z-10">
                        <div className="space-y-4">
                            <div className="flex items-center gap-4 hero-element opacity-0">
                                <span className="text-[10px] font-bold text-[#3D5A47] uppercase tracking-[1.5em] whitespace-nowrap">FIELD_JOURNAL</span>
                                <div className="flex-grow h-px bg-[#3D5A47]/20"></div>
                            </div>
                            <h1 className="hero-element opacity-0 text-5xl md:text-7xl lg:text-[7.5rem] font-serif font-black leading-[0.85] tracking-tight text-[#1E2923]">
                                Nature <br />is the <span className="text-[#3D5A47] underline decoration-1 italic font-light font-serif">Master.</span>
                            </h1>
                        </div>

                        <div className="max-w-xl space-y-8 hero-element opacity-0">
                            <p className="text-[#1E2923]/70 text-base md:text-lg leading-relaxed font-medium">
                                Welcome to Puncak & Bara. We curate high-altitude archives and organic expeditions designed for those who seek the silent architecture of the wild.
                            </p>
                            <div className="flex flex-wrap gap-6 items-center">
                                <a href="/explore" className="bg-[#3D5A47] text-white px-10 py-5 text-[11px] font-bold uppercase tracking-[0.4em] hover:bg-[#1E2923] transition-all shadow-xl">
                                    Explore Archives
                                </a>
                                <div className="flex flex-col justify-center gap-1">
                                    <span className="text-[8px] font-bold uppercase tracking-widest text-[#3D5A47]">SCROLL_DOWN</span>
                                    <div className="w-12 h-px bg-[#3D5A47]"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Organic Hero Asset */}
                    <div className="lg:col-span-6 relative h-[400px] lg:h-[650px] hero-image-container opacity-0">
                        <div className="absolute inset-4 border border-[#3D5A47]/10 -translate-x-4 translate-y-4"></div>
                        <div className="relative w-full h-full overflow-hidden shadow-2xl">
                            <img
                                src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&q=80"
                                className="w-full h-full object-cover brightness-95 contrast-110"
                                alt="Mountain range peak"
                            />
                            <div className="absolute inset-0 bg-gradient-to-t from-[#1E2923]/40 to-transparent"></div>

                            {/* Altitude Tag */}
                            <div className="absolute bottom-6 left-6 bg-[#F3F2EE]/90 backdrop-blur-md border border-[#3D5A47]/12 p-4 space-y-0.5">
                                <span className="text-[8px] font-bold text-[#3D5A47] uppercase tracking-widest block">CURRENT_ELEVATION</span>
                                <span className="text-xl font-serif italic text-[#1E2923]">3,676m_</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Marquee Slider */}
            <div className="py-8 bg-[#1E2923] border-y border-[#3D5A47]/10 relative z-30 overflow-hidden">
                <div className="flex whitespace-nowrap animate-marquee">
                    <div className="flex text-[11px] font-medium uppercase tracking-[1.5em] text-[#A8B5AA] italic animate-scroll">
                        {Array.from({ length: 4 }).map((_, idx) => (
                            <span key={idx} className="mx-8">
                                BREATHE // ASCEND // PRESERVE // 0813 3001 2100 // NATURE_ARCHIVE // SYSTEM_STABLE // &nbsp;
                            </span>
                        ))}
                    </div>
                </div>
            </div>

            {/* Ethos Axioms Section */}
            <section ref={ethosRef} className="py-24 bg-white border-b border-[#3D5A47]/5">
                <div className="max-w-7xl mx-auto px-6 lg:px-12">
                    <div className="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
                        <div className="lg:col-span-5 space-y-6">
                            <span className="text-[#3D5A47] text-[10px] font-bold uppercase tracking-[1em] block">OUR_ETHOS</span>
                            <h2 className="text-4xl md:text-5xl font-serif italic text-[#1E2923] leading-tight">
                                The Soul of <br />
                                <span className="text-[#3D5A47] underline decoration-1 not-italic font-black">Adventure.</span>
                            </h2>
                            <p className="text-gray-500 text-base leading-relaxed">
                                Every peak is a silent chapter. We provide the tools to read them with deep respect and architectural precision.
                            </p>
                        </div>

                        <div className="lg:col-span-7 grid grid-cols-1 md:grid-cols-2 gap-8">
                            {[
                                {
                                    title: 'Pure Air Protocol',
                                    desc: 'Zero-emission operations and absolute ecological respect.',
                                    icon: (
                                        <svg className="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m11.314 11.314l.707.707M12 5a7 7 0 100 14 7 7 0 000-14z" />
                                        </svg>
                                    )
                                },
                                {
                                    title: 'Heritage Mapping',
                                    desc: 'Deep integration with local mountain communities and lore.',
                                    icon: (
                                        <svg className="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                        </svg>
                                    )
                                },
                                {
                                    title: 'Organic Pulse',
                                    desc: 'Pacing calculated by your own rhythm and altitude response.',
                                    icon: (
                                        <svg className="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    )
                                },
                                {
                                    title: 'Eternal Views',
                                    desc: 'Curated vantage points reserved for the most patient eyes.',
                                    icon: (
                                        <svg className="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    )
                                }
                            ].map((ethos, index) => (
                                <div
                                    key={index}
                                    className="ethos-card opacity-0 p-8 border border-stone-200 hover:border-[#3D5A47] bg-[#F9F9F7] transition-all duration-500"
                                >
                                    <div className="w-12 h-12 bg-[#3D5A47] flex items-center justify-center mb-6 shadow-md rounded-none">
                                        {ethos.icon}
                                    </div>
                                    <h4 className="text-lg font-serif font-black text-[#1E2923] mb-2">{ethos.title}</h4>
                                    <p className="text-sm text-gray-500 leading-relaxed">{ethos.desc}</p>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </section>

            {/* Featured Peaks Section */}
            <section ref={peaksRef} className="py-24 bg-[#F3F2EE]">
                <div className="max-w-7xl mx-auto px-6 lg:px-12">
                    <div className="flex flex-col md:flex-row justify-between items-end gap-8 mb-16">
                        <div className="space-y-4">
                            <span className="text-[#3D5A47] text-[10px] font-bold uppercase tracking-[1em] block">FIELD_EXPLORATION</span>
                            <h2 className="text-4xl md:text-6xl font-serif italic text-[#1E2923] leading-none">
                                Curated Peaks.
                            </h2>
                        </div>
                        <a href="/explore" className="text-[11px] font-bold uppercase tracking-[0.3em] text-[#3D5A47] border-b border-[#3D5A47]/30 pb-1.5 hover:border-[#3D5A47] transition-all">
                            View All Journals_
                        </a>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        {trips.slice(0, 3).map((trip) => (
                            <div
                                key={trip.id}
                                className="peak-card opacity-0 group bg-white border border-stone-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500"
                            >
                                <div className="aspect-[3/4] overflow-hidden relative bg-stone-100">
                                    <img
                                        src={trip.image_url}
                                        className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000"
                                        alt={trip.nama_gunung}
                                    />
                                    <div className="absolute bottom-4 right-4 z-10">
                                        <span className="bg-black/55 backdrop-blur-md border border-white/10 px-3 py-1.5 text-[9px] font-bold uppercase tracking-widest text-white">
                                            {trip.ketinggian ? `${Number(trip.ketinggian).toLocaleString()}M ASL` : '3,142M ASL'}
                                        </span>
                                    </div>
                                </div>
                                <div className="p-8 space-y-5 bg-white">
                                    <div className="flex justify-between items-center text-[10px] font-bold uppercase tracking-widest text-[#3D5A47]/80">
                                        <span>{trip.location}</span>
                                        <span className="flex items-center gap-1.5">
                                            <span className={`w-1.5 h-1.5 rounded-full ${String(trip.level_kesulitan).toLowerCase() === 'easy'
                                                    ? 'bg-emerald-500'
                                                    : String(trip.level_kesulitan).toLowerCase() === 'medium'
                                                        ? 'bg-amber-500'
                                                        : 'bg-red-500'
                                                }`}></span>
                                            {trip.level_kesulitan}
                                        </span>
                                    </div>
                                    <h3 className="text-xl font-serif italic text-[#1E2923] leading-snug">
                                        <a href={`/trips/${trip.slug}`} className="hover:text-[#3D5A47] transition-colors relative inline-block">
                                            {trip.nama_gunung}
                                        </a>
                                    </h3>
                                    <div className="pt-4 border-t border-stone-100 flex justify-between items-center">
                                        <span className="text-base font-bold text-[#1E2923] italic">
                                            {formatPrice(trip.harga)}
                                        </span>
                                        <a href={`/trips/${trip.slug}`} className="text-[#3D5A47] text-[10px] font-bold uppercase tracking-[0.2em] flex items-center gap-2 group-hover:translate-x-1 transition-all">
                                            Journal
                                            <svg className="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Call To Action */}
            <section className="py-32 bg-[#1E2923] text-center space-y-12 px-6">
                <div className="space-y-4">
                    <span className="text-[#A8B5AA] text-[11px] font-bold uppercase tracking-[1em]">READY_TO_DESCEND</span>
                    <h2 className="text-4xl md:text-7xl font-serif italic text-white leading-none">
                        Leave <br /><span className="text-[#A8B5AA] font-light">No Trace.</span>
                    </h2>
                </div>
                <p className="text-[#A8B5AA]/70 text-lg max-w-2xl mx-auto font-medium">
                    Your next chapter begins at the tree line. Join the Sanford Nature Collective and synchronize with the altitude.
                </p>
                <div className="pt-6">
                    <a href="/register" className="bg-[#3D5A47] text-white px-12 py-5 text-[11px] font-bold uppercase tracking-[0.4em] hover:bg-white hover:text-[#1E2923] transition-all shadow-xl">
                        Begin Final Descent_
                    </a>
                </div>
            </section>
        </div>
    );
}
