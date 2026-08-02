import React from 'react';
import { createRoot } from 'react-dom/client';

// Import React Components
import Navbar from './components/Navbar';
import Footer from './components/Footer';
import Welcome from './components/Welcome';
import Explore from './components/Explore';
import Detail from './components/Detail';
import About from './components/About';
import Contact from './components/Contact';
import Blog from './components/Blog';
import BlogDetail from './components/BlogDetail';

// Helper function to mount components dynamically
const mountComponent = (id, Component) => {
    const rootEl = document.getElementById(id);
    if (rootEl) {
        try {
            const propsRaw = rootEl.getAttribute('data-props');
            const props = JSON.parse(propsRaw || '{}');
            createRoot(rootEl).render(<Component {...props} />);
        } catch (err) {
            console.error(`Error mounting component for id="${id}":`, err);
        }
    }
};

// Mount global components
mountComponent('navbar-root', Navbar);
mountComponent('footer-root', Footer);

// Mount page-specific components
mountComponent('welcome-root', Welcome);
mountComponent('explore-root', Explore);
mountComponent('detail-root', Detail);
mountComponent('about-root', About);
mountComponent('contact-root', Contact);
mountComponent('blog-root', Blog);
mountComponent('blog-detail-root', BlogDetail);
