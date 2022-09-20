import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import colors from 'vuetify/lib/util/colors'
import 'vuetify/dist/vuetify.min.css'

const vuetify = createVuetify({
    theme: { 
		dark: true,
		themes: {
			dark: {
				// primary: '#BD9D56',
				primary: '#89ABB5',
				tertiary: '#262626',
				'gray-1':'#999999',
				'gray-2':'#777777',
				'gray-3':'#555555',
				'gray-4':'#333333',
				'gray-5':'#111111',
				status_reserved:'#1E88E5',
				status_available:'#43A047',
				status_closed:'#E53935',
				'course_status_not-validated':colors.grey.darken3,
				course_status_validated:colors.green.darken3,
				course_status_cancelled:colors.red.darken3,
				course_status_done:colors.blue.darken3,
				navs: '#E0E0E0',
				'eg-gray':'#7B7B7B',
				'eg-gold':'#BD9D56',
				'eg-gold-dark':'#695936',
				'eg-red':'#D52323',
				'eg-black':'#000000',
				'eg-silver':'#B2B2B2',
				'eg-white':'#FFFFFF',
			},
			light: {
				primary: colors.green.lighten1
			}
		} 
	},
    components,
    directives,
})

export default vuetify;