window.KakioConsent = {
  save(consents, source = 'banner') {
    const ctx = window.KakioCMP;
    const payload = {
      consent_uuid: crypto.randomUUID(),
      revision: ctx.config.banner.revision,
      source,
      consents: { necessary: true, ...consents },
      meta: { url: location.href, language: document.documentElement.lang || 'sv' },
    };
    localStorage.setItem(ctx.storageKey, JSON.stringify(payload));
    fetch(`${ctx.apiBase}/api/consent/${ctx.siteKey}`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload),
    });
    this.applyScriptRules(payload.consents);
  },

  applyScriptRules(consents) {
    document.querySelectorAll('script[type="text/plain"][data-kakio-category]').forEach((node) => {
      const cat = node.dataset.kakioCategory;
      if (consents[cat]) {
        const s = document.createElement('script');
        if (node.src) s.src = node.src;
        if (node.textContent) s.textContent = node.textContent;
        document.head.appendChild(s);
        node.remove();
      }
    });
  },
};
