module.exports = {
  rules: {
    required: (v) => !!v || "Ruangan ini wajib diisi.",
    minLength: (length) => (v) =>
      (v && v.length >= length) || `Panjang minimum ${length} aksara.`,
    maxLength: (length) => (v) =>
      (v && v.length <= length) || `Panjang maksimum ${length} aksara.`,
    fixedLength: (length) => (v) =>
      (v && v.length === length) || `Panjangnya ${length} aksara.`,
    alnumUnderscoreOnly: (v) =>
      /^\w+$/.test(v) ||
      "Hanya nombor, abjad dan tanda garis bawah dibenarkan.",
    alphaSpaceOnly: (v) =>
      /^[a-zA-Z ]+$/.test(v) || "Hanya abjad dan ruang dibenarkan.",
    asciiPrintableOnly: (v) =>
      /^[ -~]+$/.test(v) || "Hanya abjad, nombor, ruang dan simbol dibenarkan.",
    containsLowercase: (v) =>
      /[a-z]/.test(v) || "Mesti mengandungi abjad huruf kecil.",
    containsUppercase: (v) =>
      /[A-Z]/.test(v) || "Mesti mengandungi abjad huruf besar.",
    containsAlpha: (v) => /[A-Za-z]/.test(v) || "Mesti mengandungi abjad.",
    containsNumber: (v) => /\d/.test(v) || "Mesti mengandungi nombor.",
    containsSymbol: (v) =>
      /[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~]/.test(v) ||
      "Mesti mengandungi simbol.",
    schoolCodeFormat: (v) =>
      (v && /^[A-Z]{3}\d{4}$/.test(v)) ||
      "Kod sekolah tidak sah, contoh: ABC1234.",
    passwordMatch: (v) => v === this.password || "Kata laluan tidak sepadan.",
  },
};
