<template>
    <form class="contactForm">

        <div class="form-group">
            <input id="name" type="text" placeholder="{{ trans('home.child_name') }}"
                name="name"
                style="border: 1px solid #F3F3F3;padding: 15px 20px;width: 100%;border-radius: 20px;"
                required>
        </div>

        <div id="name-error" class="name-error invalid-feedback">

        </div>

        <div class="form-group">
            <input id="age" type="text" maxlength="2"
                placeholder="{{ trans('home.child_age') }}" name="age"
                style="border: 1px solid #F3F3F3;padding: 15px 20px;width: 100%;border-radius: 20px;"
                required>
        </div>

        <div class="invalid-feedback age-error">

        </div>

        <div class="form-group">
            <input id="whatsapp" type="text" placeholder="{{ trans('home.whatsapp_number') }}"
                name="whatsapp"
                style="border: 1px solid #F3F3F3;padding: 15px 20px;width: 100%;border-radius: 20px;"
                required>
        </div>

        <div class="invalid-feedback whatsapp-error">

        </div>

        <div
            style="background-color:#46AA52;border-radius:30px;padding:20px 15px;text-align:center;width:50%;margin:auto;">
            <button id="submit"
                style="color:#fff;background: none;border: none;font-weight: 500;">{{ trans('home.submit') }}</button>
            <p id="loading" style="color:#fff;background: none;border: none;font-weight: 500;">
                Loading...</p>
            <input hidden type="reset" class="hidden reset-button">
        </div>
    </form>
</template>

<script>
export default {
  mounted() {
    alert("he");
  },
};
</script>
