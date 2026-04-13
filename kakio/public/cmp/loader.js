(function () {
  const script = document.currentScript;
  const siteKey = script?.dataset?.siteKey;
  if (!siteKey) return;

  const API_BASE = new URL(script.src).origin;
  const STORAGE_KEY = 'kakio_consent_' + siteKey;

  fetch(`${API_BASE}/api/banner/${siteKey}`)
    .then((r) => r.json())
    .then((config) => {
      window.KakioCMP = { siteKey, config, apiBase: API_BASE, storageKey: STORAGE_KEY };
      const consent = JSON.parse(localStorage.getItem(STORAGE_KEY) || 'null');
      if (!consent || consent.revision !== config.banner.revision) {
        load('style.css');
        load('consent.js', () => load('banner.js'));
      } else {
        load('consent.js', () => window.KakioConsent.applyScriptRules(consent.consents));
      }
    });

  function load(file, cb) {
    const el = document.createElement(file.endsWith('.css') ? 'link' : 'script');
    if (file.endsWith('.css')) {
      el.rel = 'stylesheet';
      el.href = `${API_BASE}/cmp/${file}`;
      document.head.appendChild(el);
      cb && cb();
      return;
    }
    el.src = `${API_BASE}/cmp/${file}`;
    el.defer = true;
    el.onload = () => cb && cb();
    document.head.appendChild(el);
  }
})();
