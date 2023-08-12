export const help_contact_form_address_lines = new Shepherd.Tour({
    useModalOverlay: true,
    defaultStepOptions: {
      classes: 'shadow-md bg-purple-dark',
      scrollTo: true
    }
  });


help_contact_form_address_lines.addStep({
    id: 'example-step',
    text: 'This step is attached to the bottom of the <code>.example-css-selector</code> element.',
    attachTo: {
        element: '.example-css-selector',
        on: 'bottom'
    },
    classes: 'example-step-extra-class',
    buttons: [
        {
        text: 'Siguiente',
        action: help_contact_form_address_lines.next
        }
    ]
});

