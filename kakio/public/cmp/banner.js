(function () {
  const cfg = window.KakioCMP.config;
  const b = cfg.banner;
  const root = document.createElement('div');
  root.className = 'kakio-banner';
  root.innerHTML = `<h3>${b.title}</h3><p>${b.body}</p>
    <div class="kakio-actions">
      <button id="kakio-accept">${b.accept_text}</button>
      <button id="kakio-deny">${b.deny_text}</button>
      <button id="kakio-pref">${b.preferences_text}</button>
    </div>`;
  document.body.appendChild(root);

  document.getElementById('kakio-accept').onclick = () => done({ statistics: true, marketing: true, functional: true });
  document.getElementById('kakio-deny').onclick = () => done({ statistics: false, marketing: false, functional: false });
  document.getElementById('kakio-pref').onclick = () => {
    const sc = confirm('Tillåt statistik?');
    const mc = confirm('Tillåt marknadsföring?');
    const fc = confirm('Tillåt funktionella cookies?');
    done({ statistics: sc, marketing: mc, functional: fc }, 'preferences');
  };

  function done(consents, source = 'banner') {
    window.KakioConsent.save(consents, source);
    root.remove();
  }
})();
