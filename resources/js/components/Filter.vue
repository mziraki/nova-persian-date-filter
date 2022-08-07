<template>
    <FilterContainer>
        <span>{{ filter.name }}</span>

        <template #filter>
            <date-picker
                :id="`${filter.name}-date-filter`"
                @change="handleChange"
                :clearable="true"
                :color="color"
                compact-time
                :initial-value="fieldValue"
                :input-attrs="{ style: 'direction: ltr; text-align: end;' }"
                inputClass="w-full block form-control form-control-sm form-input form-input-bordered"
                :locale="locale"
                :max="isDateTime ? '1450/12/29' : '1450/12/29 23:59:59'"
                :min="isDateTime ? '378/10/11' : '378/10/11 00:00:00'"
                :placeholder="placeholder"
                v-model="value"
                :type="type"
            >
                <template #clear-btn="{ vm }">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"
                         class="ml-2" style="height: 16px; margin-top: 9px;">
                        <path
                            fill="currentColor"
                            d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
                    </svg>
                </template>
            </date-picker>
        </template>
    </FilterContainer>
</template>

<script>
import Vue3PersianDatetimePicker from 'vue3-persian-datetime-picker'
import jMoment from 'moment-jalaali'

export default {
    components: {
        DatePicker: Vue3PersianDatetimePicker,
    },

    emits: ['change'],

    props: {
        resourceName: {
            type: String,
            required: true,
        },
        filterKey: {
            type: String,
            required: true,
        },
        lens: String,
    },

    data: () => ({
        value: null,
    }),

    created() {
        this.setCurrentFilterValue()
    },

    mounted() {
        Nova.$on('filter-reset', this.setCurrentFilterValue)
    },

    beforeUnmount() {
        Nova.$off('filter-reset', this.setCurrentFilterValue)
    },

    methods: {
        setCurrentFilterValue() {
            this.value = this.fieldValue
        },

        handleChange() {
            this.$store.commit(`${this.resourceName}/updateFilterState`, {
                filterClass: this.filterKey,
                value: this.altDateValue,
            })

            this.$emit('change')
        },
    },

    computed: {
        altDateValue() {
            return this.value
                ? jMoment(this.value, this.format).format(this.isDateTime ? 'YYYY-MM-DD HH:mm:ss' : 'YYYY-MM-DD')
                : ''
        },

        color() {
            return this.filter.color || `rgb(30, 136, 229)`
        },

        fieldValue() {
            return this.filter.currentValue ? jMoment(this.filter.currentValue).format(this.format) : ''
        },

        filter() {
            return this.$store.getters[`${this.resourceName}/getFilter`](this.filterKey)
        },

        format() {
            return this.filter.format || (this.isDateTime ? 'jYYYY/jMM/jDD HH:mm' : 'jYYYY/jMM/jDD')
        },

        isDateTime() {
            return this.filter.type === 'datetime';
        },

        locale() {
            return this.filter.locale || 'fa,en'
        },

        placeholder() {
            return jMoment().format(this.format)
        },

        type() {
            return this.filter.type || `date`
        },
    },
}
</script>
