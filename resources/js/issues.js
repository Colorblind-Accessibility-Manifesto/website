import easyScroll from 'easy-scroll';
import customSelect from 'custom-select';

const issuesSection = document.getElementById('issues-section');
const issuesSelect  = document.getElementById('filter-issues');

customSelect('select');

issuesSelect.addEventListener('change', () => {
    const currentSlug = issuesSelect.value;
    const issues      = document.querySelectorAll('#issues-section .issue');

    for (let issue of issues) {
        let visible = true;

        if (
            currentSlug !== issue.getAttribute('data-slug')
            && currentSlug !== ''
        ) {
            visible = false;
        }

        issue.style.display = visible ? 'initial' : 'none';
    }

    setTimeout(() => {
        easyScroll({
            'scrollableDomEle': window,
            'direction': 'bottom',
            'duration': 700,
            // 'easingPreset': 'linear',
            'scrollAmount': issuesSection.getBoundingClientRect().y
        });
    }, 0);
})
