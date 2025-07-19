// @ts-check

// This runs in Node.js - Don't use client-side code here (browser APIs, JSX...)

/**
 * Creating a sidebar enables you to:
 - create an ordered group of docs
 - render a sidebar for each doc of that group
 - provide next/previous navigation

 The sidebars can be generated from the filesystem, or explicitly defined here.

 Create as many sidebars as you want.

 @type {import('@docusaurus/plugin-content-docs').SidebarsConfig}
 */
const sidebars = {
  tutorialSidebar: [
    'intro',
    'dashboard-overview',
    'login',
    'navigation',
    {
      type: 'category',
      label: 'Fitur Dashboard',
      items: [
        'features/dashboard',
        'features/transaksi',
        'features/sampah',
        'features/kategori',
        'features/user-management',
        'features/bank-sampah',
        'features/event',
        'features/poin',
        'features/artikel',
        'features/laporan',
      ],
    },
    'faq',
    'troubleshooting',
    'contact',
  ],
};

export default sidebars;
