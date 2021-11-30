import Swup from 'swup';
import SwupFormsPlugin from '@swup/forms-plugin';

const swup = new Swup({
    plugins: [
        new SwupFormsPlugin({formSelector: 'form[data-swup-form]'}),
    ]
});
