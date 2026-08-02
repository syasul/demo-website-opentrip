import React, { useState, useEffect, useRef } from 'react';
import { animate, stagger } from 'animejs';

export default function Navbar({ auth, routes }) {
    const [isOpen, setIsOpen] = useState(false);
    const [scrolled, setScrolled] = useState(false);
    const menuRef = useRef(null);
    const linksRef = useRef(null);

    // Track scroll to toggle background glass effect and logos
    useEffect(() => {
        const handleScroll = () => {
            if (window.scrollY > 20) {
                setScrolled(true);
            } else {
                setScrolled(false);
            }
        };
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    // Animate mobile menu drawer
    useEffect(() => {
        if (isOpen) {
            // Slide in menu
            animate(menuRef.current, {
                translateX: ['100%', '0%'],
                duration: 500,
                ease: 'outExpo'
            });
            // Stagger reveal links
            animate('.mobile-link', {
                opacity: [0, 1],
                translateY: [20, 0],
                delay: stagger(80, { start: 150 }),
                duration: 600,
                ease: 'outQuad'
            });
        } else {
            // Slide out menu
            animate(menuRef.current, {
                translateX: '100%',
                duration: 400,
                ease: 'inQuad'
            });
        }
    }, [isOpen]);

    return (
        <>
            <nav
                id="main-nav"
                className={`fixed top-0 left-0 w-full z-[100] px-6 lg:px-12 flex items-center justify-between transition-all duration-500 flex-nowrap ${scrolled
                    ? 'bg-[#F3F2EE]/90 backdrop-blur-md border-b border-stone-200 h-20 shadow-md'
                    : 'bg-transparent h-24'
                    }`}
            >
                <a href="/" className="group flex items-center shrink-0">
                    {/* Logo changes variant based on background/scroll */}
                    <img
                        src="/images/logo_dark.png"
                        alt="Logo"
                        className="h-22 w-auto object-contain transition-all duration-300"
                    />
                </a>

                <div className="hidden lg:flex absolute left-1/2 -translate-x-1/2 items-center gap-10 opacity-70 flex-nowrap">
                    <a className="text-[11px] font-bold uppercase tracking-[0.3em] hover:text-[#3D5A47] transition-all" href="/explore">Expeditions</a>
                    <a className="text-[11px] font-bold uppercase tracking-[0.3em] hover:text-[#3D5A47] transition-all" href="/blog">Archives</a>
                    <a className="text-[11px] font-bold uppercase tracking-[0.3em] hover:text-[#3D5A47] transition-all" href="/about">About Us</a>
                    <a className="text-[11px] font-bold uppercase tracking-[0.3em] hover:text-[#3D5A47] transition-all" href="/contact">Contact</a>
                </div>

                <div className="flex items-center gap-4 lg:gap-10 shrink-0 flex-nowrap">
                    <div className="flex items-center gap-4 lg:gap-8 flex-nowrap">
                        {auth && auth.check ? (
                            <a href="/dashboard" className="hidden sm:block text-[11px] font-bold uppercase tracking-[0.3em] border border-[#3D5A47]/30 px-6 py-3 hover:bg-[#3D5A47] hover:text-white transition-all">
                                Dashboard
                            </a>
                        ) : (
                            <>
                                <a href="/login" className="hidden md:block text-[11px] font-bold uppercase tracking-[0.3em] text-[#1E2923] hover:text-[#3D5A47]">
                                    Login
                                </a>
                                <a href="/register" className="hidden sm:block bg-[#3D5A47] text-white px-6 lg:px-8 py-3.5 text-[11px] font-bold uppercase tracking-[0.3em] hover:bg-[#1E2923] transition-all shadow-md">
                                    Begin Journey
                                </a>
                            </>
                        )}
                    </div>

                    {/* Mobile Toggle */}
                    <button
                        onClick={() => setIsOpen(!isOpen)}
                        className="lg:hidden w-10 h-10 flex flex-col items-center justify-center gap-1.5 focus:outline-none"
                    >
                        <span className={`w-6 h-0.5 bg-[#3D5A47] transition-transform duration-300 ${isOpen ? 'rotate-45 translate-y-2' : ''}`}></span>
                        <span className={`w-6 h-0.5 bg-[#3D5A47] transition-opacity duration-300 ${isOpen ? 'opacity-0' : ''}`}></span>
                        <span className={`w-6 h-0.5 bg-[#3D5A47] transition-transform duration-300 ${isOpen ? '-rotate-45 -translate-y-2' : ''}`}></span>
                    </button>
                </div>
            </nav>

            {/* Mobile Menu Drawer */}
            <div
                ref={menuRef}
                className="fixed inset-0 z-[200] translate-x-full flex flex-col p-12 bg-[#F3F2EE]/98 backdrop-blur-xl border-l border-emerald-900/10"
            >
                <div className="flex justify-between items-center mb-16">
                    <span className="text-xl font-serif italic text-[#3D5A47]">Menu</span>
                    <button
                        onClick={() => setIsOpen(false)}
                        className="text-[11px] font-bold uppercase tracking-[0.5em] text-[#3D5A47] focus:outline-none"
                    >
                        Close
                    </button>
                </div>
                <div ref={linksRef} className="flex flex-col gap-8 my-auto">
                    <a href="/" className="mobile-link text-4xl font-serif italic text-[#1E2923] opacity-0">Home</a>
                    <a href="/explore" className="mobile-link text-4xl font-serif italic text-[#1E2923] opacity-0">Expeditions</a>
                    <a href="/blog" className="mobile-link text-4xl font-serif italic text-[#1E2923] opacity-0">Archives</a>
                    <a href="/about" className="mobile-link text-4xl font-serif italic text-[#1E2923] opacity-0">About Us</a>
                    <a href="/contact" className="mobile-link text-4xl font-serif italic text-[#1E2923] opacity-0">Contact</a>
                </div>
                <div className="mt-auto flex flex-col gap-4">
                    {auth && auth.check ? (
                        <a href="/dashboard" className="bg-[#3D5A47] text-white text-center py-5 text-[12px] font-bold uppercase tracking-[0.3em]">
                            Dashboard
                        </a>
                    ) : (
                        <>
                            <a href="/login" className="border border-[#3D5A47]/30 text-center py-5 text-[12px] font-bold uppercase tracking-[0.3em] text-[#1E2923]">
                                Login
                            </a>
                            <a href="/register" className="bg-[#3D5A47] text-white text-center py-5 text-[12px] font-bold uppercase tracking-[0.3em]">
                                Begin Journey
                            </a>
                        </>
                    )}
                </div>
            </div>
        </>
    );
}
