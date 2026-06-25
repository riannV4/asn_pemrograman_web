const SCALES = {
    ribu: 1_000,
    juta: 1_000_000,
    miliar: 1_000_000_000,
    triliun: 1_000_000_000_000,
};

const UNITS = {
    nol: 0,
    satu: 1,
    se: 1,
    dua: 2,
    tiga: 3,
    empat: 4,
    lima: 5,
    enam: 6,
    tujuh: 7,
    delapan: 8,
    sembilan: 9,
};

const SPECIALS = {
    sepuluh: 10,
    sebelas: 11,
    seratus: 100,
    seribu: 1_000,
};

function normalizeText(input) {
    return String(input ?? '')
        .toLowerCase()
        .replace(/rp\.?/g, ' ')
        .replace(/[^\w\s.,]/g, ' ')
        .replace(/\s+/g, ' ')
        .trim();
}

function getScaleAfterNumber(text, numberEndIndex) {
    const afterNumber = text.slice(numberEndIndex).trim();
    const scaleMatch = afterNumber.match(/^(ribu|juta|miliar|triliun)\b/);

    return scaleMatch ? SCALES[scaleMatch[1]] : 1;
}

function parseNumericToken(token, scale) {
    const separators = token.match(/[.,]/g) || [];

    if (scale > 1 && separators.length === 1) {
        return Number.parseFloat(token.replace(',', '.'));
    }

    if (separators.length > 0) {
        return Number.parseInt(token.replace(/[.,]/g, ''), 10);
    }

    return Number.parseInt(token, 10);
}

function parseDigitAmount(text) {
    const match = text.match(/\d+(?:[.,]\d+)*/);

    if (!match) {
        return null;
    }

    const scale = getScaleAfterNumber(text, match.index + match[0].length);
    const number = parseNumericToken(match[0], scale);

    if (!Number.isFinite(number)) {
        return null;
    }

    return Math.round(number * scale);
}

function parseWordGroup(tokens) {
    let group = 0;
    let total = 0;
    let hasNumber = false;

    for (const token of tokens) {
        if (Object.prototype.hasOwnProperty.call(SPECIALS, token)) {
            group += SPECIALS[token];
            hasNumber = true;
            continue;
        }

        if (Object.prototype.hasOwnProperty.call(UNITS, token)) {
            group += UNITS[token];
            hasNumber = true;
            continue;
        }

        if (token === 'belas') {
            group = group > 0 ? group + 10 : 10;
            hasNumber = true;
            continue;
        }

        if (token === 'puluh') {
            group = (group || 1) * 10;
            hasNumber = true;
            continue;
        }

        if (token === 'ratus') {
            group = (group || 1) * 100;
            hasNumber = true;
            continue;
        }

        if (Object.prototype.hasOwnProperty.call(SCALES, token)) {
            total += (group || 1) * SCALES[token];
            group = 0;
            hasNumber = true;
        }
    }

    total += group;

    return hasNumber && total > 0 ? total : null;
}

function parseWordAmount(text) {
    const tokens = text
        .replace(/[.,]/g, ' ')
        .split(/\s+/)
        .filter(Boolean);

    return parseWordGroup(tokens);
}

export function parseIndonesianAmount(input) {
    const text = normalizeText(input);

    if (!text) {
        return null;
    }

    const digitAmount = parseDigitAmount(text);

    if (digitAmount !== null && digitAmount > 0) {
        return digitAmount;
    }

    const wordAmount = parseWordAmount(text);

    return wordAmount !== null ? Math.round(wordAmount) : null;
}
