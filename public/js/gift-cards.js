(function () {
  'use strict';

  const preview = document.getElementById('gift-preview');
  const amountEl = document.getElementById('gift-preview-amount');
  const customInput = document.getElementById('gift-custom-amount');
  const hiddenAmount = document.getElementById('gift-amount-hidden');

  function updateAmount(v) {
    if (amountEl && v) amountEl.textContent = '$' + v;
    if (hiddenAmount && v) hiddenAmount.value = v;
  }

  document.querySelectorAll('.gift-amount-radio').forEach(function (r) {
    r.addEventListener('change', function () {
      if (customInput) customInput.value = '';
      updateAmount(r.value);
    });
  });

  customInput?.addEventListener('input', function () {
    document.querySelectorAll('.gift-amount-radio').forEach(function (r) {
      r.checked = false;
    });
    updateAmount(customInput.value || '0');
  });

  const occasionHidden = document.getElementById('gift-occasion-hidden');
  const occasionTextInput = document.getElementById('gift-custom-occasion');
  const occasionMatchHint = document.getElementById('gift-occasion-match-hint');
  const occasionPicks = document.querySelectorAll('.gift-occasion-pick');
  const presetOccasions = window.__giftOccasions || [];
  const defaultPreset = presetOccasions[0] || null;

  function normalizeOccasionText(text) {
    return text.trim().toLowerCase().replace(/[!?.]+$/g, '').replace(/\s+/g, ' ');
  }

  function findPresetOccasion(text) {
    const normalized = normalizeOccasionText(text);
    if (!normalized) return null;

    const asSlug = normalized.replace(/\s+/g, '-');

    return presetOccasions.find(function (o) {
      const name = o.name.trim().toLowerCase();
      const id = o.id.toLowerCase();
      const headline = (o.headline || '').trim().toLowerCase().replace(/[!?.]+$/g, '');

      return normalized === name
        || normalized === id
        || normalized === headline
        || asSlug === id;
    }) || null;
  }

  function clearOccasionPicks() {
    occasionPicks.forEach(function (r) {
      r.checked = false;
    });
  }

  function selectOccasionPick(id) {
    clearOccasionPicks();
    const radio = document.querySelector('.gift-occasion-pick[data-id="' + id + '"]');
    if (radio) radio.checked = true;
  }

  function updateOccasionPreview(headline) {
    const occasionEl = document.getElementById('gift-preview-occasion');
    if (occasionEl && headline) {
      occasionEl.textContent = headline;
    }
    if (!preview) return;
    preview.classList.remove('gc-preview--swap');
    void preview.offsetWidth;
    preview.classList.add('gc-preview--swap');
  }

  function showOccasionMatchHint(preset) {
    if (!occasionMatchHint) return;
    if (!preset) {
      occasionMatchHint.hidden = true;
      occasionMatchHint.textContent = '';
      return;
    }
    occasionMatchHint.hidden = false;
    occasionMatchHint.textContent = 'Matched “' + preset.name + '” — showing that card.';
  }

  function setCustomOccasion(text) {
    if (occasionHidden) occasionHidden.value = 'custom';
    clearOccasionPicks();
    occasionTextInput?.setAttribute('required', 'required');
    showOccasionMatchHint(null);
    updateOccasionPreview(text || 'Your occasion');
  }

  function setPresetOccasion(preset, syncInput) {
    if (occasionHidden) occasionHidden.value = preset.id;
    selectOccasionPick(preset.id);
    occasionTextInput?.removeAttribute('required');
    if (syncInput && occasionTextInput) {
      occasionTextInput.value = preset.name;
    }
    showOccasionMatchHint(preset);
    updateOccasionPreview(preset.headline);
  }

  function syncFromTextInput() {
    const text = occasionTextInput?.value || '';
    const trimmed = text.trim();
    const preset = findPresetOccasion(trimmed);

    if (preset) {
      setPresetOccasion(preset, false);
      return;
    }

    if (trimmed) {
      setCustomOccasion(trimmed);
      return;
    }

    if (occasionHidden) occasionHidden.value = 'custom';
    clearOccasionPicks();
    occasionTextInput?.setAttribute('required', 'required');
    showOccasionMatchHint(null);
    updateOccasionPreview('Your occasion');
  }

  function initOccasionState() {
    const text = occasionTextInput?.value.trim() || '';

    if (text) {
      syncFromTextInput();
      return;
    }

    const hiddenVal = occasionHidden?.value;
    const preset = hiddenVal && hiddenVal !== 'custom'
      ? presetOccasions.find(function (o) { return o.id === hiddenVal; })
      : defaultPreset;

    if (preset) {
      if (occasionHidden) occasionHidden.value = preset.id;
      selectOccasionPick(preset.id);
      occasionTextInput?.removeAttribute('required');
      showOccasionMatchHint(null);
      updateOccasionPreview(preset.headline);
    }
  }

  occasionTextInput?.addEventListener('input', syncFromTextInput);

  occasionPicks.forEach(function (r) {
    r.addEventListener('change', function () {
      if (!r.checked) return;
      setPresetOccasion({
        id: r.dataset.id,
        name: r.dataset.name,
        headline: r.dataset.headline,
      }, true);
    });
  });

  const form = document.getElementById('gift-form');
  form?.addEventListener('submit', function () {
    const text = occasionTextInput?.value.trim() || '';
    if (text) {
      syncFromTextInput();
      return;
    }
    const checked = document.querySelector('.gift-occasion-pick:checked');
    if (checked && occasionHidden) {
      occasionHidden.value = checked.dataset.id;
      occasionTextInput?.removeAttribute('required');
      return;
    }
    if (defaultPreset) {
      if (occasionHidden) occasionHidden.value = defaultPreset.id;
      selectOccasionPick(defaultPreset.id);
    }
  });

  initOccasionState();

  function applyCardStyle(radio) {
    if (!preview || !radio) return;
    const themed = radio.dataset.themed === '1';
    if (themed) {
      preview.classList.add('gc-preview--themed');
      preview.style.background = radio.dataset.bg;
      preview.style.color = radio.dataset.color;
    } else {
      preview.classList.remove('gc-preview--themed');
      preview.style.background = '';
      preview.style.color = '';
    }
    preview.classList.remove('gc-preview--swap');
    void preview.offsetWidth;
    preview.classList.add('gc-preview--swap');
  }

  document.querySelectorAll('input[name="design"]').forEach(function (r) {
    r.addEventListener('change', function () {
      applyCardStyle(r);
    });
  });

  const balanceBtn = document.getElementById('gift-check-balance');
  const balanceCode = document.getElementById('gift-balance-code');
  const balanceMsg = document.getElementById('gift-balance-msg');

  balanceBtn?.addEventListener('click', async function () {
    const code = balanceCode?.value.trim();
    if (!code) {
      balanceMsg.style.display = 'block';
      balanceMsg.style.color = '#9c3b25';
      balanceMsg.textContent = 'Please enter a gift card code.';
      return;
    }
    balanceMsg.style.display = 'block';
    balanceMsg.style.color = '#6b6b6b';
    balanceMsg.textContent = 'Checking balance…';
    try {
      const res = await fetch(window.__giftBalanceUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
          'Accept': 'application/json',
        },
        body: JSON.stringify({ code: code }),
      });
      const data = await res.json();
      if (data.ok) {
        balanceMsg.style.color = '#3d7a52';
        balanceMsg.textContent = 'Balance for ' + data.code + ': $' + Number(data.balance).toFixed(2);
      } else {
        balanceMsg.style.color = '#9c3b25';
        balanceMsg.textContent = data.message || 'Gift card not found.';
      }
    } catch (e) {
      balanceMsg.style.color = '#9c3b25';
      balanceMsg.textContent = 'Could not check balance. Please try again.';
    }
  });
})();
