const rules_user_pincode = v => {
  if (!v) return 'Enter pincode or city';
  if (/^\d+$/.test(v)) {
    if (v.length !== 6) return 'Enter 6-digit pincode';
    if (v[0] === '0') return 'Invalid pincode';
    return '';
  }
  if (v.length < 2) return 'City name too short';
  if (!/^[\p{L}\p{M}0-9 .,'’/()&-]{2,60}$/u.test(v)) return 'Enter valid city name';
  return '';
};

const testCases = [
  { val: '', expected: 'Enter pincode or city' },
  { val: '123', expected: 'Enter 6-digit pincode' },
  { val: '012345', expected: 'Invalid pincode' },
  { val: '201301', expected: '' },
  { val: '110001', expected: '' },
  { val: 'N', expected: 'City name too short' },
  { val: 'Noida', expected: '' },
  { val: 'South Delhi', expected: '' },
  { val: 'Pune', expected: '' },
  { val: 'Noida Sector 62', expected: '' },
  { val: 'Bengaluru (Karnataka)', expected: '' },
  { val: '@@@###', expected: 'Enter valid city name' }
];

let allPassed = true;
for (const tc of testCases) {
  const res = rules_user_pincode(tc.val);
  const ok = res === tc.expected;
  if (!ok) {
    allPassed = false;
    console.error(`FAIL: val="${tc.val}" -> got "${res}", expected "${tc.expected}"`);
  } else {
    console.log(`PASS: val="${tc.val}" -> "${res || 'VALID'}"`);
  }
}

if (allPassed) {
  console.log('ALL TESTS PASSED!');
} else {
  process.exit(1);
}
