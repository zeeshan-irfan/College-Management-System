<x-form-template id="updateDisableInfoForm" method="PUT"
                 route="updateDisableInfo" 
                 heading="Disabled candidate (optional)" 
                 subheading="Check only if you have any disablity.">


                 <div class="col-12">
                    <div class="mb-3">
                        <label for="disabled1" class="form-label text-light-emphasis">Are you Disabled?</label>
                
                        <!-- Radio button for "No" -->
                        <div class="form-check mb-2">
                            <input class="form-check-input" 
                                   type="radio" 
                                   name="disabled" 
                                   id="disabled1" 
                                   value="no" 
                                   {{ (old('disabled') ?? Auth::user()->personalinfo->disabled ?? '') === 'no' ? 'checked' : '' }}
                                   required>
                            <label class="form-check-label" for="disabled1">
                                No (I'm not disabled)
                            </label>
                        </div>
                
                        <!-- Radio button for "Yes" -->
                        <div class="form-check ">
                            <input class="form-check-input" 
                                   type="radio" 
                                   name="disabled" 
                                   id="disabled2" 
                                   value="yes" 
                                   {{ (old('disabled') ?? Auth::user()->personalinfo->disabled ?? '') === 'yes' ? 'checked' : '' }}>
                            <label class="form-check-label" for="disabled2">
                                Yes
                            </label>
                        </div>
                
                        <!-- Declaration text, always visible -->
                        <div class="bg-light p-3 rounded text-secondary">
                            <p class="mb-1">I, Mr/Ms. <strong>{{ Auth::user()->name }}</strong>,</p>
                            <p class="mb-1">S/O, D/O Mr. <strong>{{ old('fname') ?? Auth::user()->fatherinfo->fname ?? '' }}</strong>,</p>
                            <p class="mb-0">
                                hereby solemnly declare that I am a Disabled Person.
                            </p>
                        </div>
                
                        <!-- Certificate notice text -->
                        <div class="text-primary mt-2">
                            Certificate issued by the Disability Board / any other authority must be provided upon document verification.
                        </div>
                    </div>
                </div>

</x-form-template>