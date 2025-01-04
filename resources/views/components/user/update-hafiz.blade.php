<x-form-template id="updateHafizInfoForm" method="PUT"
                 route="updateHafizInfo" 
                 heading="Hafiz e Quran (optional)" 
                 subheading="Check only if you are Hafiz-e-Quran.">



                <div class="col-12">
                    <div class="mb-3">
                        <label for="hafiz1" class="form-label text-light-emphasis">Are you a Hafiz-e-Quran?</label>
                
                        <!-- Radio button for "No" -->
                        <div class="form-check mb-2">
                            <input class="form-check-input" 
                                   type="radio" 
                                   name="hafiz" 
                                   id="hafiz1" 
                                   value="no" 
                                   {{ (old('hafiz') ?? Auth::user()->personalinfo->hafiz ?? '') === 'no' ? 'checked' : '' }}
                                   required>
                            <label class="form-check-label" for="hafiz1">
                                No (I'm not a Hafiz-e-Quran)
                            </label>
                        </div>
                
                        <!-- Radio button for "Yes" -->
                        <div class="form-check ">
                            <input class="form-check-input" 
                                   type="radio" 
                                   name="hafiz" 
                                   id="hafiz2" 
                                   value="yes" 
                                   {{ (old('hafiz') ?? Auth::user()->personalinfo->hafiz ?? '') === 'yes' ? 'checked' : '' }}>
                            <label class="form-check-label" for="hafiz2">
                                Yes
                            </label>
                        </div>
                
                        <!-- Declaration text, always visible -->
                        <div class="bg-light p-3 rounded text-secondary">
                            <p class="mb-1">I, Mr/Ms. <strong>{{ Auth::user()->name }}</strong>,</p>
                            <p class="mb-1">S/O, D/O Mr. <strong>{{ old('fname') ?? Auth::user()->fatherinfo->fname ?? '' }}</strong>,</p>
                            <p class="mb-0">
                                hereby solemnly declare that I am a Muslim Hafiz-e-Quran.
                            </p>
                        </div>
                
                        <!-- Certificate notice text -->
                        <div class="text-primary mt-2">
                            Certificate issued by a recognized institution/authority must be provided upon document verification.
                        </div>
                    </div>
                </div>
                

</x-form-template>